<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $cost
 * @property string $hour
 * @property integer $agency_id
 * @property integer $create_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['agency_id', 'create_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'type', 'cost', 'hour'], 'string', 'max' => 255],
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
            'cost' => 'Cost',
            'hour' => 'Hour',
            'agency_id' => 'Agency ID',
            'create_by' => 'Create By',
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

    //Get list Plan
    public function getListPlan($type, $agency_id = null) {
        $arrs = static::find()->andFilterWhere(['and', ['=', 'type', $type] , ['=', 'agency_id', $agency_id]])->all();
        $result = [];
        foreach ($arrs as $arr) {
            $result[$arr->id] = $arr->name;
        }
        return $result;
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
