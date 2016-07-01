<?php
/**
 * Created by PhpStorm.
 * User: zhenyu
 * Date: 2016/7/2
 * Time: 1:59
 */

namespace app\common\service;

use app\models\CrondServerPerfLog;

class CrondServerPerfLogService
{
    function getLogs(){
        $logs = CrondServerPerfLog::find()->orderBy('sampling_time desc')->asArray()->all();
        return $logs;
    }

    function addLog($serverId,$cpu,$memory){
        $entity = new CrondServerPerfLog();

        $entity->setAttributes([
            'crond_server_id'=>$serverId,
            'cpu'=>$cpu,
            'memory'=>$memory,
            'sampling_time'=>date("Y-m-d H:i:s"),
        ]);
        $result = $entity->save();
        return $result;
    }

}