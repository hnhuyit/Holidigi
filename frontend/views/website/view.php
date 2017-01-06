<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Website */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Websites', 'url' => ['info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="website-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'des:ntext',
            'createBy.email',
            'status',
            'siteOwner.name',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
            //'class' => 'btn btn-danger',
            //'data' => [
            //    'confirm' => 'Are you sure you want to delete this item?',
            //    'method' => 'post',
            //],
        //]) ?>
    </p>

</div>
