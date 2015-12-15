<?php
namespace common\helpers;

use Yii;
use kartik\select2\Select2;
use kartik\file\FileInput;
use common\widgets\datePicker;

class Render
{
    private $form;
    private $model;
    private $viewMode;
    private $disabledFields;

    public function __construct($form, $model, $viewMode = false, $disabledFields = [])
    {
        $this->form = $form;
        $this->model = $model;
        $this->viewMode = $viewMode;
        $this->disabledFields = (array)$disabledFields;
    }

    function textField($attribute, $fieldOptions = [], $inputOptions = [])
    {
        $defaultFieldOptions = ['options' => ['class' => 'form-group']];
        $defaultInputOptions = ['class' => 'form-control'];

        $fieldOptions = array_replace_recursive($defaultFieldOptions, $fieldOptions);
        $inputOptions = array_replace_recursive($defaultInputOptions, $inputOptions);

        if ($this->viewMode || in_array($attribute, $this->disabledFields)) {
            $fieldOptions['enableClientValidation'] = false;
            $inputOptions['readonly'] = 'readonly';
        }

        return $this->form->field($this->model, $attribute, $fieldOptions)->textInput($inputOptions);
    }

    function dateField($attribute, $widgetOptions = [], $fieldOptions = [], $inputOptions = [])
    {
        $fieldOptions = [
            'options' => ['class' => 'form-group'],
            'template' => '
                {label}
                <div class="input-group">
                    {input}
                    <span class="input-group-addon calendar-button" role="button">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>
                </div>
                {error}
            ',
        ];
        $inputOptions = ['class' => 'form-control'];

        if ($this->viewMode || in_array($attribute, $this->disabledFields)) {
            $fieldOptions['enableClientValidation'] = false;
            $inputOptions['readonly'] = 'readonly';
        }

        $defaultWidgetOptions = [
            'language' => Yii::$app->language,
            'dateFormat' => 'php:d/m/Y',
            'saveDateFormat' => 'php:Y-m-d',
            'options' => [
                'placeholder' => $this->model->getAttributeLabel($attribute),
                'title' => $this->model->getAttributeLabel($attribute),
                'class' => 'form-control',
            ],
        ];
        $widgetOptions = array_replace_recursive($defaultWidgetOptions, $widgetOptions);

        return $this->form->field($this->model, $attribute, $fieldOptions)->widget(DatePicker::classname(),
            $widgetOptions,
            $inputOptions
        );
    }

    function selectField($attribute, $data, $widgetOptions = [], $fieldOptions = [])
    {
        $defaultFieldOptions = ['options' => ['class' => 'form-group']];
        $defaultInputOptions = [
            'class' => 'form-control select',
            'placeholder' => $this->model->getAttributeLabel($attribute).'...',
        ];
        $fieldOptions = array_replace_recursive($defaultFieldOptions, $fieldOptions);
        $inputOptions = array_replace_recursive($defaultInputOptions, isset($widgetOptions['inputOptions']) ? $widgetOptions['inputOptions'] : []);

        if ($this->viewMode || in_array($attribute, $this->disabledFields)) {
            $fieldOptions['enableClientValidation'] = false;
            $inputOptions['disabled'] = 'disabled';
        }

        $defaultWidgetOptions = [
            'data' => $data,
            'options' => $inputOptions,
            'pluginOptions' => [
                'allowClear' => true,
                'minimumResultsForSearch' => 1,
            ],
        ];
        $widgetOptions = array_replace_recursive($defaultWidgetOptions, $widgetOptions);

        return $this->form->field($this->model, $attribute, $fieldOptions)->widget(Select2::classname(), $widgetOptions);
    }

    function fileField($attribute, $widgetOptions = [], $fieldOptions = [])
    {
        $defaultWidgetOptions = [
            'model' => $this->model,
            'attribute' => $attribute,
            'options' => [],
            'pluginOptions' => [
                'showPreview' => false,
                'showUpload' => false,
                'browseLabel' => '',
                'removeLabel' => '',
            ],
        ];
        $widgetOptions = array_replace_recursive($defaultWidgetOptions, $widgetOptions);

        return $this->form->field($this->model, $attribute, $fieldOptions)->widget(FileInput::className(), $widgetOptions);
    }
}

