<?php
namespace app\common\service;

use app\models\CrondServer;
use app\models\CrondServerQuery;
use app\models\CronTab;

/**
 * Created by lizt
 * Date: 2016/6/29
 * Time: 18:04
 */
class CrondServerService
{
    private $_db=null;

    /**
     * CrondServerService constructor.
     */
    public function __construct()
    {
        $this->_db = \yii::$app->getDb();;
    }

    function getCrondServers(){
        /**
         * @var $query CrondServer
         */
        $query = \yii::createObject(CrondServer::className());
        return $query->find()->asArray()->all();
    }

    /**
     * @param $svrid 服务器ID
     * @return \app\models\CrondServer[]|array
     * @throws \yii\base\InvalidConfigException
     */
    function getCronTabs($svrid){
        /**
         * @var $query CronTab
         */
        $query = \yii::createObject(CronTab::className());
        return $query->find()
            ->where(['server_id'=>$svrid])
            ->asArray()->all();
    }

    function getCronTab($id){
        /**
         * @var $query CronTab
         */
        $query = \yii::createObject(CronTab::className());
        return $query->find()
            ->where(['id'=>$id])
            ->asArray()->one();
    }

    function saveCronTab($model){
        $tab =new CronTab();
        $tab->load($model);
        $tab->save();
    }
}