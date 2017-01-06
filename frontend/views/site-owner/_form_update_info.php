<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SiteOwner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-owner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'create_by')->textInput() ?>

    <?php // echo $form->field($model, 'status')->textInput() ?>

    <?php // echo $form->field($model, 'website')->textInput() ?>

    <?php // echo $form->field($model, 'agency_id')->textInput() ?>

    <?php // echo $form->field($model, 'plan_id')->dropDownList($plans) ?>

    <?php // echo $form->field($model, 'bill_id')->textInput() ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>
    
    <?php // echo $form->field($model, 'first_name')->textInput() ?>

    <?php // echo $form->field($model, 'last_name')->textInput() ?>
    
    <?php // echo $form->field($model, 'username')->textInput() ?>

    <?php // echo $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?php // echo $form->field($model, 'password_hash')->passwordInput() ?>
    
    <?php // echo $form->field($model, 'phone')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
