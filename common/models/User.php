<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property integer $is_supper
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $phone
 * @property string $email
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $create_by
 * @property string $auth_key
 * @property integer $status
 * @property integer $last_login
 * @property integer $site_owner_id
 * @property integer $agency_id
 * @property integer $is_owner
 * @property string $role
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    
    public $old_password;
    public $new_password;
    public $repeat_password;

    public $roles = [
        'Others' => 'Others',
        'Project Manager' => 'Project Manager',
        'Tester' => 'Tester',
        'Devoloper' => 'Devoloper',
        'Designer' => 'Designer',
        'Others' => 'Others',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email', 'role'], 'required'],
            [['status','last_login', 'create_by', 'is_supper', 'agency_id', 'site_owner_id', 'is_owner'], 'integer'],
            [['first_name', 'last_name', 'username', 'password_hash', 'email', 'role'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'email'],
            [['email', 'username'], 'unique'],
            [['email', 'password_reset_token'], 'unique'],
            [['email'], 'filter', 'filter' => 'trim'],
            //Change password
            [['old_password, new_password, repeat_password'], 'required', 'on' => 'changepassword'],
            [['old_password'], 'findPasswords', 'on' => 'changepassword'], //check old pwd match...

            [['new_password, repeat_password'], 'string', 'min' => 3, 'on' => 'changepassword'],
            [['new_password, repeat_password'], 'filter', 'filter'=>'trim', 'on' => 'changepassword'],

            [['repeat_password'], 'compare', 'compareAttribute'=>'new_password', 'message'=>'Passwords do not match', 'on' => 'changepassword'],
        ];
    }

    //matching the old password with your existing password.
    public function findPasswords()
    {
        if (!$this->verifyPassword($this->old_password)) {
            $this->addError('old_password', 'Old password is incorrect.');
        }
    }
    
    public function verifyPassword($password) 
    {
        $dbpassword = static::findOne(['email'=>Yii::$app->user->identity->email, 'status' => self::STATUS_ACTIVE])->password_hash;
        return Yii::$app->security->validatePassword($password, $dbpassword);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Finds user by last_login
     *
     * @param string $lastlogin
     * @return static|null
     */
    public static function findByLastlogin($lastlogin)
    {
        return static::findOne(['last_login' => $lastlogin, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Finds user by email
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
    * Check is Admin User
    */
    public static function isUserAdmin($email)
    {
        if (static::findOne(['email' => $email, 'is_supper' => 1, 'status' => self::STATUS_ACTIVE])){
            return true;
        } else {
            return false;
        }
    }
    
    /**
    * Check is valid User
    */
    public static function isValidUser($email){
        if (static::findOne(['email' => $email, 'is_supper' => 0, 'status' => self::STATUS_ACTIVE])){
            return true;
        } else {
            return false;
        }
    }
    
    // Getlist Users belong a Agency
    public function getListUsers() {
        $arrs = static::find()
                ->andFilterWhere(['=', 'create_by', Yii::$app->user->id])
                ->andFilterWhere(['=', 'is_owner', 0])->all();
        $result = [];
        foreach ($arrs as $arr) {
            $result[$arr->id] = "$arr->role $arr->first_name $arr->last_name";
        }
        return $result;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateBy()
    {
        return $this->hasOne(User::className(), ['id' => 'create_by']);
    }
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getAgency()
    // {
    //     return $this->hasOne(Agency::className(), ['id' => 'agency_id']);
    // }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteOwner()
    {
        return $this->hasOne(SiteOwner::className(), ['id' => 'site_owner_id']);
    }
}
