<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'is_supper')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'create_by')->textInput() ?>

    <?php //echo  $form->field($model, 'status')->textInput() ?>

    <?php //echo  $form->field($model, 'last_login')->textInput() ?>

    <?php //echo  $form->field($model, 'site_owner_id')->textInput() ?>

    <?php //echo  $form->field($model, 'agency_id')->textInput() ?>

    <?php //echo  $form->field($model, 'is_owner')->textInput() ?>

    <?= $form->field($model, 'role')->dropDownList($model->roles) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
