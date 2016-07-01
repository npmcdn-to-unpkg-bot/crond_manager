<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 22:04
 */

namespace app\common\service;

use app\common\support\Curl;
use yii\base\Exception;

class BaseService
{
    protected $_curl;
    public function __construct()
    {
        $this->_curl = new Curl;
    }

    public function request_get($url, $param) {
        return $this->_curl->get($url, $param);
    }

    public function request_post($url, $param, $curl_timeout = 300) {
        $this->_curl->setOption(CURLOPT_TIMEOUT, $curl_timeout);

        //增加安全认证token
        $paramArray = [];
        if(!empty($param)){
            $paramArray = json_decode($param,TRUE);
        }
        $timeStamp = date("Y-m-d H:i:s");

        if(is_string($paramArray['data'])){
            $temp = json_decode($paramArray['data'],true);
            $temp['timestamp'] = $timeStamp;
            $paramArray['data'] = json_encode($temp);
        }else{
            $paramArray['data']['timestamp'] = $timeStamp;
        }

        $param = json_encode($paramArray);

        //设置header
        $headers['Content-Type']='text/plain; charset=UTF-8';//curl默认使用application/x-www-form-urlencoded，象屿投资的SaveGjjl接口会报400错误。
        $this->_curl->setHeaders($headers);

        $res =  $this->_curl->post($url, $param);

        $status = $this->_curl->getStatus();
        if($status != 200){
            //两种错误场景
            $error_msg = '';
            if($this->_curl->getError()){
                //curl错误，比如主机无法找到、网址格式错误等
                $error_msg = $this->_curl->getError();
            }
            else{
                //请求到了对方服务器，但是可能端口号错误、iis服务停止、web.config错误导致内部错误、业务代码错误等，此时返回的就是错误页面
                $error_msg = $res;
            }

            throw new Exception('请求Erp接口失败。返回状态码：'.$status.'。详细错误信息：'.$error_msg,2);
        }else{
            $res_data = json_decode($res,true);
            return $res_data;
        }
    }
}