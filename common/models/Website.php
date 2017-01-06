<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "website".
 *
 * @property integer $id
 * @property string $name
 * @property string $des
 * @property integer $create_by
 * @property integer $status
 * @property integer $site_owner_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Website extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'website';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_by'], 'required'],
            [['des'], 'string'],
            [['create_by', 'status', 'site_owner_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'des' => 'Des',
            'create_by' => 'Create By',
            'status' => 'Status',
            'site_owner_id' => 'Site Owner ID',
            'siteOwner.name' => 'Site Owner Name',
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
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['website_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteOwner()
    {
        return $this->hasOne(SiteOwner::className(), ['id' => 'site_owner_id']);
    }
    

    // Getlist Website belong a Agency
    public function getListWebsites() {
        $arrs = static::find()
                ->andFilterWhere(['=', 'create_by', Yii::$app->user->id])->all();
        $result = [];
        foreach ($arrs as $arr) {
            $result[$arr->id] = $arr->name;
        }
        return $result;
    }
}
