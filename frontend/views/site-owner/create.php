<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SiteOwner */

$this->title = 'Thêm khách hàng';
$this->params['breadcrumbs'][] = ['label' => 'Site Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-owner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'plans' => $plans,
    ]) ?>

</div>
