<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        // ['label' => 'About', 'url' => ['/site/about']],
        // ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        if(Yii::$app->user->identity->role == 'Agency') {

            $menuItems[] = ['label' => 'Team', 'url' => ['/user/team', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Site Owner', 'url' => ['/site-owner/index', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Websites', 'url' => ['/website/index', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Tasks', 'url' => ['/task/index', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Plans', 'url' => ['/plan/index', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Bills', 'url' => ['/bill/index', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Invoices', 'url' => ['/invoice/index', 'agency_id' => Yii::$app->user->identity->agency_id]];
            $menuItems[] = ['label' => 'Info Agency', 'url' => ['/agency/info']];
        } else {
            if(Yii::$app->user->identity->role == 'Site Owner') {

                $menuItems[] = ['label' => 'Website', 'url' => ['/website/info', 'site_owner_id' => Yii::$app->user->identity->site_owner_id]];
                $menuItems[] = ['label' => 'Bill', 'url' => ['/bill/site-owner']];
                $menuItems[] = ['label' => 'Tasks', 'url' => ['/task/siteowner', 'site_owner_id' => Yii::$app->user->identity->site_owner_id]];
                $menuItems[] = ['label' => 'Info Site Owner', 'url' => ['/site-owner/info']];
            } else {
                $menuItems[] = ['label' => 'Tasks', 'url' => ['/task/mytask']];
            }
        }
        $menuItems[] = ['label' => 'Info Profile', 'url' => ['/user/info']];
        $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->first_name . " " .  Yii::$app->user->identity->last_name . ')',
            ['class' => 'btn btn-link']
        )
        . Html::endForm()
        . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>  
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
