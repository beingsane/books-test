<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

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
                'value' => function($model) {
                    if (!$model->preview) return '';

                    $link = Html::a(
                        '<img src="'. Url::toRoute($model->getPreviewUrl()) .'"></img>',
                        Url::toRoute($model->getPreviewUrl()),
                        ['class' => 'image-gallery-item']
                    );

                    return Html::tag('div', $link, ['class' => 'image-gallery']);
                }
            ],
            'author_id',
            'date:date',
            'date_create:relativeTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
