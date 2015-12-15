<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\Render;
use common\models\Author;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php $render = new Render($form, $model); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $render->selectField('author_id', Author::getList()) ?>

    <?= $render->dateField('date') ?>


    <?php if ($model->preview) { ?>
        <br>
        <div class="image-gallery">
            <a class="image-gallery-item" href="<?= Url::to($model->getPreviewUrl()) ?>">
                <img src="<?= Url::to($model->getPreviewUrl()) ?>"></img>
            </a>
        </div>
        <br>
    <?php } ?>

    <?= $render->fileField('preview_file') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
