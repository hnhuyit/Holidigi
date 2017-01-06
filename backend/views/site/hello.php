<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
?>
	<?php $form = ActiveForm::begin([
		'layout' => 'horizontal',
		'fieldConfig' => [
	        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
	        'horizontalCssClasses' => [
	            //'label' => 'col-sm-4',
	            //'offset' => 'col-sm-offset-4',
	            //'wrapper' => 'col-sm-8',
	            'error' => '',
	            'hint' => '',
	        ],
	    ],

	]);
?>
<?= $form->field($model, 'name')->textInput() ?>
<?= $form->field($model, 'status')->passwordInput() ?>

<?php ActiveForm::end(); ?>



<?php
////// 
	echo Alert::widget([
	    'options' => [
	        'class' => 'alert-info',
	    ],
	    'body' => 'Say hello...',
	]);



	Alert::begin([
	    'options' => [
	        'class' => 'alert-warning',
	    ],
	]);

	echo 'Say hello...';

	Alert::end();
?>