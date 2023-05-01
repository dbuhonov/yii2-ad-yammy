<?php

namespace dmitrybukhonov\adyammy\backend\assets;

use yii\web\AssetBundle;

class AdYammyAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dmitrybukhonov/yii2-ad-yammy/src/backend/assets';
    public $js = [
        'js/AdYammy.js'
    ];
}
