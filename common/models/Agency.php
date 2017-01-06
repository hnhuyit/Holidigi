<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agency".
 *
 * @property integer $id
 * @property string $name
 * @property string $des
 * @property integer $create_by
 * @property integer $plan_id
 * @property integer $bill_id
 * @property integer $status
 * @property string $avatar
 * @property string $token
 * @property integer $created_at
 * @property integer $updated_at
 */
class Agency extends \yii\db\ActiveRecord
{
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
            [['name', 'create_by', 'plan_id', 'bill_id', 'token'], 'required'],
            [['des'], 'string'],
            [['create_by', 'plan_id', 'bill_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
            'plan_id' => 'Plan ID',
            'bill_id' => 'Bill ID',
            'status' => 'Status',
            'avatar' => 'Avatar',
            'token' => 'Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
