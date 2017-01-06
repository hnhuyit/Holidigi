<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\grid\SerialColumn;
use yii\grid\CheckboxColumn;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AgencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Agency', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'id',
            'name',
            'des:ntext',
            'create_by',
            'plan_id',
            // 'bill_id',
            // 'status',
            // 'avatar',
            // 'token',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=> function($url,$model){
                    return Html::a('View',$url,['class'=>'btn btn-xs btn-primary']);
                },
                    'update'=> function($url,$model){
                    return Html::a('<span class ="glyphicon glyphicon-pencil"></span> Edit',$url,['class'=>'btn btn-xs btn-success']);
                },
                    'delete'=> function($url,$model){
                    return Html::a('<span class ="glyphicon glyphicon-remove"></span> Delete',$url,
                        [
                            'class'=>'btn btn-xs btn-danger',
                            'data-confirm' =>'Bạn có chắc muốn xóa',
                            'data-method' =>'post', 
                        ]
                        );
                    },
                ]   
            ],
        ],
    ]); ?>
</div>
