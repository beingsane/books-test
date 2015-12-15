<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MagnificPopupAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/magnific-popup/dist';

    public $js = [
        'jquery.magnific-popup.js',
    ];

    public $css = [
        'magnific-popup.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
