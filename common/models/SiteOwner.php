<?php

namespace common\models;

use Yii;

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
            [['name', 'create_by', 'website', 'agency_id', 'plan_id'], 'required'],
            [['des'], 'string'],
            [['create_by', 'status', 'agency_id', 'plan_id', 'bill_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'avatar', 'website'], 'string', 'max' => 255],
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
        ];
    }
}
