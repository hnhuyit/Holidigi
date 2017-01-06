<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SiteOwner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Site Owners', 'url' => ['info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-owner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'des:ntext',
            'avatar',

            'createBy.email',

            'status',
            'website',

            'agency.name',
            'plan.name',

            'bill_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['updateinfo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
            //'class' => 'btn btn-danger',
            //'data' => [
            //    'confirm' => 'Are you sure you want to delete this item?',
            //   'method' => 'post',
            //],
        //]) ?>
    </p>

</div>
