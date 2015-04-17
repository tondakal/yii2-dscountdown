<?php

namespace tondakal\widgets;

use yii\web\AssetBundle;

class DsCountdownAsset extends AssetBundle
{
    public $sourcePath = '@bower/dscountdown';
    public $css = ['dscountdown.css'];
    public $js = ['dscountdown.min.js'];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
