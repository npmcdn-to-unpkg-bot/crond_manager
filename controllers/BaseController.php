<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 16:25
 */

namespace app\controllers;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class BaseController  extends Controller
{
    /**
     * 输出json格式数据
     * @param array  $data    输出数据
     * @param int    $retCode 自定义错误码
     * @param string $errMsg  错误信息
     * @param bool   $success
     * @throws \yii\base\ExitException
     */
    protected function exportJson($data = [], $retCode = 0, $errMsg = '', $success = true)
    {
        $response = \Yii::$app->response;
        $response->format = $response::FORMAT_JSON;

        if ($success === false) {
            $response->setStatusCode(500);
        }

        $exportData['data'] = $data;
        $exportData['retCode'] = $retCode;
        $exportData['errMsg'] = $errMsg;
        $response->data = $exportData;

        \Yii::$app->end();
    }

}