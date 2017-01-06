<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SiteOwnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Site Owner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'des:ntext',
            'avatar',
            'create_by',
            // 'status',
            // 'website',
            // 'agency_id',
            // 'plan_id',
            // 'bill_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
