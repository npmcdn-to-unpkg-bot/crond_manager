<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crontab".
 *
 * @property string $id
 * @property string $server_id
 * @property string $cron_user
 * @property string $cron_name
 * @property string $frequency
 * @property string $cron_file
 * @property string $status
 * @property string $tag
 * @property string $jog_guid
 * @property string $receive
 * @property string $receive_mail
 */
class CronTab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crontab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['server_id'], 'integer'],
            [['cron_user', 'cron_name', 'frequency', 'cron_file'], 'string', 'max' => 200],
            [['status', 'tag' ,'jog_guid','receive','receive_mail'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'server_id' => 'Server ID',
            'cron_user' => 'Cron User',
            'cron_name' => 'Cron Name',
            'frequency' => 'Frequency',
            'cron_file' => 'Cron File',
            'status' => 'Status',
            'tag' => 'Tag',
            'jog_guid'=>'jog guid',
            'receive'=>'receive',
            'receive_mail'=>'receive mail'
        ];
    }
}
