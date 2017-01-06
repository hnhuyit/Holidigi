<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $start
 * @property string $end
 * @property integer $object_id
 * @property string $object_type
 * @property integer $cost
 * @property integer $status
 * @property integer $sent
 * @property integer $agency_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'object_type'], 'required'],
            [['start', 'end'], 'safe'],
            [['object_id', 'cost', 'status', 'sent', 'agency_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'type', 'object_type'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'start' => 'Start',
            'end' => 'End',
            'object_id' => 'Object ID',
            'object_type' => 'Object Type',
            'cost' => 'Cost',
            'status' => 'Status',
            'sent' => 'Sent',
            'agency_id' => 'Agency ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => strtotime(\common\helpers\PreHelper::formatDate()),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgency()
    {
        return $this->hasOne(Agency::className(), ['id' => 'agency_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
    
}
