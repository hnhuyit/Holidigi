<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "bill".
 *
 * @property integer $id
 * @property string $card_type
 * @property string $card_name
 * @property string $card_number
 * @property string $expiration_date
 * @property string $security_code
 * @property string $phone_number
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property integer $created_at
 * @property integer $updated_at
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['card_type', 'card_name', 'card_number', 'expiration_date', 'security_code', 'phone_number', 'address', 'city', 'state', 'country', 'postal_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_type' => 'Card Type',
            'card_name' => 'Card Name',
            'card_number' => 'Card Number',
            'expiration_date' => 'Expiration Date',
            'security_code' => 'Security Code',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
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
    public function getAgencies()
    {
        return $this->hasMany(Agency::className(), ['bill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteOwners()
    {
        return $this->hasMany(SiteOwner::className(), ['bill_id' => 'id']);
    }
}
