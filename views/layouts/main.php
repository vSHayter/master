<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-dark bg-dark', //fixed-top
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            ['label' => 'Home', 'url' => ['/']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/auth/login']]
            ) : (
            ['label' => ''. Yii::$app->user->identity->username . '',
                'items' => [
                    ['label' => 'Profile', 'url' => ['/user/profile']],
                    ['label' => 'Favourites', 'url' => ['/user/favourites']],
                    ['label' => 'Trips', 'url' => ['/user/trips']],
                    ['label' => 'Ratings', 'url' => ['/user/ratings']],
                    ['label' => 'Feedbacks', 'url' => ['/user/feedbacks']],
                    ['label' => 'Logout', 'url' => ['/auth/logout'], 'options' => ['method' => 'post']],
                ]]
//                '<li>'
//                . Html::beginForm(['/auth/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->username . ')',
//                    ['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    </header>

    <?= $content ?>

</div>



<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Master <?= date('Y') ?></p>

<!--       <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
