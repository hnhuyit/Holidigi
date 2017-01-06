<?php
  use yii\helpers\Html;
  use common\widgets\Alert;
  use yii\widgets\ActiveForm;

  $this->title = 'Users';
  $this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['info']];
  $this->params['breadcrumbs'][] = 'Change Password';
?>

<?= Alert::widget() ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'old_password')->passwordInput() ?>

<?= $form->field($model, 'new_password')->passwordInput() ?>

<?= $form->field($model, 'repeat_password')->passwordInput() ?>

<div class="from-group">
  <div>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
  </div>
</div>

<?php $form = ActiveForm::end() ?>