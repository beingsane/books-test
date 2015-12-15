<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\Render;
use common\models\Author;

/* @var $this yii\web\View */
/* @var $model frontend\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?php $render = new Render($form, $model); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $render->selectField('author_id', Author::getList()) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-md-6">
            <?= $render->dateField('date_from') ?>
        </div>

        <div class="col-md-6">
            <?= $render->dateField('date_to') ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
