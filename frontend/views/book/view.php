<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'date_update',
                'value' => Yii::$app->formatter->asDate($model->date),
            ],
            [
                'attribute' => 'author_id',
                'value' => $model->author->name,
            ],
            [
                'attribute' => 'date_create',
                'value' => Yii::$app->formatter->asDate($model->date_create),
            ],
            [
                'attribute' => 'date_update',
                'value' => Yii::$app->formatter->asDate($model->date_create),
            ],
            'preview',
        ],
    ]) ?>

</div>
