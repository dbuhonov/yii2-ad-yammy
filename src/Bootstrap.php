<?php

namespace dmitrybukhonov\adyammy;

use Yii;
use dmitrybukhonov\adyammy\Module;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        /** @var Module */
        $module = $app->getModule('adyammy');

        Yii::setAlias('adyammy.imagePath', $module->imagePath);
        Yii::setAlias('adyammy.imageUrl', $module->imageUrl);

        if ($module->backendAppId == Yii::$app->id) {
            $module->controllerNamespace = 'dmitrybukhonov\adyammy\backend\controllers';

            $urlRules = [
                'adv-setting/index' => 'adyammy/adv-setting/index',
                'adv-setting/update' => 'adyammy/adv-setting/update',
                'adv-setting/create' => 'adyammy/adv-setting/create',
                'adv-setting/delete-image' => 'adyammy/adv-setting/delete-image',
            ];

            $app->getUrlManager()->addRules($urlRules, false);
        }
    }
}
