<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "agency".
 *
 * @property integer $id
 * @property string $name
 * @property string $des
 * @property integer $create_by
 * @property integer $status
 * @property string $avatar
 * @property integer $plan_id
 * @property integer $bill_id
 * @property string $token
 * @property integer $created_at
 * @property integer $updated_at
 */
class Agency extends \yii\db\ActiveRecord
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
        return 'agency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'plan_id'], 'required'],
            [['first_name', 'last_name', 'username', 'email', 'password_hash', 'phone'], 'required', 'on' => 'create'],
            [['des'], 'string'],
            [['email'], 'email'],
            [['phone'], 'string', 'max' => 15],
            [['create_by', 'status', 'created_at', 'updated_at', 'plan_id', 'bill_id'], 'integer'],
            [['name', 'avatar', 'token'], 'string', 'max' => 255],
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
            'Plan_id ' => 'Plan',
            'Bill_id ' => 'Bill',
            'status' => 'Status',
            'avatar' => 'Avatar',
            'token' => 'Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'User Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',

            'createBy.username' => 'Create By',
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
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteOwners()
    {
        return $this->hasMany(SiteOwner::className(), ['agency_id' => 'id']);
    }
}
