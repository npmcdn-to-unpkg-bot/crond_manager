<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crond_server_perf_log".
 *
 * @property integer $id
 * @property integer $crond_server_id
 * @property integer $cpu
 * @property integer $memory
 * @property datetime $sampling_time
 */
class CrondServerPerfLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crond_server_perf_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crond_server_id','cpu','memory'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crond_server_id' => 'crond_server_id',
            'cpu' => 'cpu',
            'memory' => 'Memory',
            'sampling_time' => 'sampling_time'

        ];
    }
}
