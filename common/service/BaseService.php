<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/1
 * Time: 22:04
 */

namespace app\common\service;


class BaseService
{
    public function __construct()
    {
        $this->_db = \yii::$app->getDb();;
    }
}