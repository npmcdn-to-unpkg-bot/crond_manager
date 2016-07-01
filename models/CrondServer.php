<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crond_server".
 *
 * @property string $id
 * @property string $name
 * @property string $api_host
 * @property integer $contab_num
 * @property string $cpu_model
 * @property string $memory
 * @property string $disk
 * @property string $comment
 */
class CrondServer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crond_server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contab_num'], 'integer'],
            [['name', 'api_host'], 'string', 'max' => 200],
            [['cpu_model', 'memory', 'disk'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'api_host' => 'Api Host',
            'contab_num' => 'Contab Num',
            'cpu_model' => 'Cpu Model',
            'memory' => 'Memory',
            'disk' => 'Disk',
            'comment' => 'Comment',
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
