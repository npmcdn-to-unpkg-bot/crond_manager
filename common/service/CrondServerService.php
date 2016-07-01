<?php
namespace app\common\service;

use app\models\CrondServer;
use app\models\CrondServerQuery;

/**
 * Created by lizt
 * Date: 2016/6/29
 * Time: 18:04
 */
class CrondServerService
{
    function getCrondServers(){
        $db = \yii::$app->getDb();
        /**
         * @var $query CrondServer
         */
        $query = \yii::createObject(CrondServer::className());
        return $query->find()->asArray()->all();
    }
}