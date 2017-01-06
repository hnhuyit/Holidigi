<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Agency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'des')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'create_by')->textInput() ?>

    <?php //echo $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'plan_id')->dropDownList($plans) ?>

    <?php //echo $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'created_at')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>
    
    <?php //echo $form->field($model, 'first_name')->textInput() ?>

    <?php //echo $form->field($model, 'last_name')->textInput() ?>
    
    <?php //echo $form->field($model, 'username')->textInput() ?>

    <?php //echo $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?php //echo $form->field($model, 'password_hash')->passwordInput() ?>
    
    <?php //echo $form->field($model, 'phone')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
