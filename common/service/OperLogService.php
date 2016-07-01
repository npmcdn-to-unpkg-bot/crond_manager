<?php
/**
 * Created by lizt
 * Date: 2016/7/1
 * Time: 23:10
 */

namespace app\common\service;


use app\models\OperLog;

class OperLogService
{
    const OPER_STATUS_SUCC='成功';
    const OPER_STATUS_FAILED='失败';

    public static function write($msg='', $user = '',$status=''){
        $log = new OperLog();
        $log->log_time=date('Y-m-d H:i:s');
        $log->oper_user = '管理员';
        $log->oper_status = $status;
        $log->content=$msg;
        $log->save();
    }

    /**
     * @param $svrid 服务器ID
     * @return \app\models\CrondServer[]|array
     * @throws \yii\base\InvalidConfigException
     */
    function getLogs( $key=''){
        /**
         * @var $query OperLog
         */
        $query = \yii::createObject(OperLog::className());
        $query2 = $query->find();

        if(!empty($key)){
            $query2 = $query2->Where(['or',['like','oper_user',$key],['like','content',$key]]);
        }

        return $query2->asArray()->all();
    }
}