<?php
    use backend\assets\AppAsset;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="">
</head>
<body>
<?php $this->beginBody() ?>
<div id="page-wrapper">

    <header class="header">

            <?php 
                NavBar::begin([
                    'brandLabel' => 'My Company',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-static-top',
                    ],
                ]);
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                ];
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                } else {
                    $menuItems[] = ['label' => 'Agencies', 'url' => ['/agency'], 'class' => 'fjsjdfn'];
                    $menuItems[] = ['label' => 'Site Owner', 'url' => ['/site-owner']];
                    $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
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
        
    </header> <!-- /header -->

    <div class="clearfix"></div>

    <section class="slider">

    </section> <!-- /slider -->

    <div class="clearfix"></div>

    <div id="main-content">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]); 
            ?>
            <?= Alert::widget() ?>


            <?= $content ?>
        </div>  
    </div> <!-- #main-content -->

    <div class="clearfix"></div>

    <footer class="footer">

        <div class="footer-widget">
            
        </div> <!-- .footer-widget -->

        <div class="clearfix"></div>

        <div class="footer-copyright">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </div> <!-- .footer-copyright -->

    </footer> <!-- /footer -->

</div> <!-- #end page-wrapper -->

<div class="clearfix"></div>

<div id="style-selector">

    <div class="back-to-top">

    </div> <!-- .back-to-top -->

    <div class="clearfix"></div>
    <!-- More Orther -->
</div> <!-- .style-selector -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

