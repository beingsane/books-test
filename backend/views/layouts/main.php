<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\components\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
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
                    'brandLabel' => 'My Company' . ' - ' . Yii::t('app', 'Admin panel'),
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);

                if (Yii::$app->user->isGuest) {
                    // emulate default navigation for guest users
                    $menuItems = [
                        ['label' => Yii::t('app', 'Home'), 'url' => ['/../']],
                    ];
                    $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/user/login']];
                    // $menuItems[] = ['label' => Yii::t('app', 'Registration'), 'url' => ['/user/register']];
                } else {
                    $menuItems = [
                        ['label' => Yii::t('app', 'Admin panel'), 'url' => Yii::$app->homeUrl],
                    ];
                    $menuItems[] = ['label' => Yii::t('app', 'User management'), 'url' => ['/user/admin/index']];

                    $menuItems[] = [
                        'label' => '<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;' . Yii::t('app', 'Site'),
                        'url' => ['/../'],
                        'encode' => false,
                    ];
                    $menuItems[] = [
                        'label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/user/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ];
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
                <p class="pull-left">&copy; <?= date('Y') ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
