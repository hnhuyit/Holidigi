<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "site_owner".
 *
 * @property integer $id
 * @property string $name
 * @property string $des
 * @property string $avatar
 * @property integer $create_by
 * @property integer $status
 * @property string $website
 * @property integer $agency_id
 * @property integer $plan_id
 * @property integer $bill_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class SiteOwner extends \yii\db\ActiveRecord
{

    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password_hash;
    public $phone;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_owner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'website'], 'required'],
            [['first_name', 'last_name', 'username', 'email', 'password_hash', 'phone'], 'required', 'on' => 'create'],
            [['des'], 'string'],
            [['email'], 'email'],
            [['phone'], 'string', 'max' => 15],
            [['create_by', 'status', 'agency_id', 'plan_id', 'bill_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'website', 'avatar'], 'string', 'max' => 255],
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
            'avatar' => 'Avatar',
            'create_by' => 'Create By',
            'status' => 'Status',
            'website' => 'Website',
            'agency_id' => 'Agency ID',
            'plan_id' => 'Plan ID',
            'bill_id' => 'Bill ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'User Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',

            'agency.name' => 'Agency By',
            'plan.name' => 'Plan',
            'createBy.email' => 'User Email By',
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
    
    //Get list SiteOwner
    public function getListSO() {
        $arrs = static::find()->andFilterWhere(['=', 'create_by', Yii::$app->user->id])->all();
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
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
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
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['site_owner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebsites()
    {
        return $this->hasMany(Website::className(), ['site_owner_id' => 'id']);
    }
    
}
