<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crond_server_perf_log".
 *
 * @property string $id
 * @property string $crond_server_id
 * @property string $cpu
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
            'cpu' => 'Api Host',
            'memory' => 'Memory',
            'sampling_time' => 'Disk'

        ];
    }

    /**
     * @inheritdoc
     * @return CrondServerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CrondServerQuery(get_called_class());
    }
}
