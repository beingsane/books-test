<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
        <br>
        <br>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <a data-toggle="collapse" href="#filter">
                <?= Yii::t('app', 'Filter') ?>
            </a>
            <?= Html::a('<span class="text-muted">'.Yii::t('app', 'Reset filter').'</span>', ['index'], ['class' => 'pull-right']) ?>
        </div>
        <div id="filter" class="panel-collapse collapse <?= $searchModel->isOpen() ? 'in' : 'out' ?>">
            <div class="panel-body">
                <?= $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function ($model) {
                    if (!$model->preview) return '';

                    $link = Html::a(
                        '<img src="'. Url::toRoute($model->getPreviewUrl()) .'"></img>',
                        Url::toRoute($model->getPreviewUrl()),
                        ['class' => 'image-gallery-item']
                    );

                    return Html::tag('div', $link, ['class' => 'image-gallery']);
                }
            ],
            'author.name',
            'date:date',
            'date_create:relativeTime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            null,
                            [
                                'title' => Yii::t('yii', 'View'),
                                'class' => 'btn-view-book',
                                'role' => 'button',
                                'data-url' => Url::toRoute(['view', 'id' => $model->id])
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

<?php
    Modal::begin([
        'id' => 'book-view-dialog',
        'header' => '<h4>'.Yii::t('app', 'View').'</h4>',
    ]);

    Modal::end();
?>

</div>
