<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oper_log".
 *
 * @property string $id
 * @property string $log_time
 * @property string $oper_user
 * @property string $oper_status
 * @property string $content
 * @property string $oper_ip
 */
class OperLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oper_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_time'], 'safe'],
            [['content'], 'string'],
            [['oper_user', 'oper_status', 'oper_ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_time' => 'Log Time',
            'oper_user' => 'Oper User',
            'oper_status' => 'Oper Status',
            'content' => 'Content',
            'oper_ip' => 'Oper Ip',
        ];
    }
}
