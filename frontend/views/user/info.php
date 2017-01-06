<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Agency */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agency-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'is_supper',
            'first_name',
            'last_name',
            'username',
            'phone',
            'email:email',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'create_by',
            'status',
            'last_login',
            'site_owner_id',
            'agency_id',
            'is_owner',
            'role',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update', ['updateinfo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Change Pass', ['changepassword'], ['class' => 'btn btn-danger']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
            //'class' => 'btn btn-danger',
            //'data' => [
            //    'confirm' => 'Are you sure you want to delete this item?',
            //    'method' => 'post',
            //],
        //]) ?>
    </p>

</div>
