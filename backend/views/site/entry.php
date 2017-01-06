<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\HelloWidget;
?>
<?php $form = ActiveForm::begin([
		'id'=>'form',
		'options'=>['class' => 'class-form'],
	]); ?>

    <?= $form->field($model, 'name')->label('Name')?>


    <?= $form->field($model, 'phone') ?>


	<?= $form->field($model, 'password')->passwordInput() ?>

	<?= $form->field($model, 'name')->textInput()->hint('Please enter your name')->label('Name') ?>

	<?= $form->field($model, 'email')->input('email') ?>

	<?= $form->field($model, 'uploadFile')->fileInput();?>

	<?= $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']);?>

	<?= $form->field($model, 'items[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);?>

	<?= $form->field($model, 'agency')->dropdownList(
	    common\models\Agency::find()->select(['name', 'id'])->column(),
	    ['prompt'=>'Chon em di']

	);?>

	<?= $form->field($model, 'agency')->dropdownList(
	    yii\helpers\ArrayHelper::map(common\models\Agency::find()->all(),'id','name'),
        [
            'prompt'=> 'Are you OK?'
        ]
	);?>
	

	<?= $form->field($model, 'name')->radio(['label' => 'yes', 'value' => 1])?>

	
	<?= HelloWidget::widget(['message' => 'Good morning']) ?>

    <div class="form-group">
    <div class="col-lg-offset-11 col-lg-1">
    	<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
        
    </div>

<?php ActiveForm::end(); ?>
