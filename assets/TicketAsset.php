<?php

namespace akiraz2\support\assets;

use yii\web\AssetBundle;

class TicketAsset extends AssetBundle {
    public $sourcePath = '@vendor/tommygooden/yii2-ticket-support/assets/default';
    public $baseUrl = '@web';
    public $css = [
        'css/ticket-style.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\bootstrap5\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
