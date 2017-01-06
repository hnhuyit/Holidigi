<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Agency;

class EntryForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public $uploadFile;
    public $country;
    public $items;
    public $agency;

    public function rules()
    {
        return [
	        [['name', 'email'], 'trim'],
	    	[['name', 'email'], 'default'],
            [['email', 'phone', 'password', 'agency'], 'required'],
            ['email', 'email'],
            ['name', 'string', 'max' => 255],
            ['name', 'required', 'message' => 'Please choose a username.'],

            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

			//Chứa phương thức trong lớp
            	// rememberMe must be a boolean value
	            ['rememberMe', 'boolean'],
	            //password is validated by validatePassword() 
	            //['password', 'validatePassword'],
				['country', 'validateCountry'],// an inline validator defined as the model method validateCountry()
			//chứa phương thức inline

	      		//['state', 'required', 'when' => function($model) { 
			    //return $model->country == 'USA';
			    //}]

			    // ['state', 'required', 'when' => function ($model) {
			    //     return $model->country == 'USA';
			    // }, 'whenClient' => "function (attribute, value) {
			    //     return $('#country').val() == 'USA';
			    // }"]
			    
			///On ACtion
			//[['username', 'password', '!secret'], 'required', 'on' => 'login']
            
        ];
    } 

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
    public function validateCountry($attribute, $params)
    {
        if (!in_array($this->$attribute, ['USA', 'Web'])) {
            $this->addError($attribute, 'The country must be either "USA" or "Web".');
        }
    }
}