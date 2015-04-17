<?php

namespace tondakal\widgets;

use yii\web\AssetBundle;

class DscountdownAsset extends AssetBundle
{
    public $sourcePath = '@bower/dscountdown';
    public $css = ['dscountdown.css'];
    public $js = ['dscountdown.js'];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
