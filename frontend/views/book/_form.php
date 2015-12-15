<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\Render;
use common\models\Author;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $render = new Render($form, $model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $render->selectField('author_id', Author::getList()) ?>

    <?= $render->dateField('date') ?>

    <?php // $form->field($model, 'preview')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
