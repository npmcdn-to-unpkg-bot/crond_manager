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
    function getCronTabs($svrid, $tag='', $key=''){
        /**
         * @var $query CronTab
         */
        $query = \yii::createObject(CronTab::className());
        $query2 = $query->find()
            ->where(['server_id'=>$svrid]);
        if(!empty($tag)){
            $query2 = $query2->andWhere(['like','tag',$tag]);
        }

        if(!empty($key)){
            $query2 = $query2->andWhere(['like','cron_name',$key]);
        }

        return $query2->asArray()->all();
    }

    function getCronTab($id){
        /**
         * @var $query CronTab
         */
        $query = \yii::createObject(CronTab::className());
        return $query->find()
            ->where(['id'=>$id])
            ->asArray(true)
            ->one();
    }

    function saveCronTab($model){
        $isnew=false;
        if(empty($model['id'])){
            $isnew = true;
        }

        $tab =new CronTab();
        if(!$isnew){
            /**
             * @var $query CronTab
             */
            $query = \yii::createObject(CronTab::className());
            $tab = $query->find()
                ->where(['id'=>$model['id']])
                ->one();
        }

        $tab->setAttributes($model,false);

        if($isnew){
            $tab->save();
        }else{
            $tab->update();
        }

    }

    function deleteCronTab($id){
        CronTab::deleteAll(['id'=>$id]);
    }

    function getTags($sid){
        /**
         * @var $query CronTab
         */
        $query = \yii::createObject(CronTab::className());
        return $query->find()
            ->select(['tag'])
            ->where(['server_id'=>$sid])
            ->distinct()
            ->asArray()->all();
    }
}