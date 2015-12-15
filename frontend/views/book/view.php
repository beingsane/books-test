<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => Url::previous()];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        function getPreviewHtml($model)
        {
            if (!$model->preview) return '';

            $link = Html::a(
                '<img src="'. Url::to($model->getPreviewUrl()) .'"></img>',
                Url::to($model->getPreviewUrl()),
                ['class' => 'image-gallery-item']
            );

            return Html::tag('div', $link, ['class' => 'image-gallery']);
        }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date:date',
            [
                'attribute' => 'author_id',
                'value' => $model->author->name,
            ],
            'date_create:date',
            'date_update:date',
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => getPreviewHtml($model),
            ],
        ],
    ]) ?>

</div>
