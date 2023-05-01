<?php

namespace dmitrybukhonov\adyammy\helpers;

use Yii;

final class ImageHelper
{
    public static function getUrl(?string $path): ?string
    {
        if ($path) {
            return Yii::getAlias('@adyammy.imageUrl/' . $path);
        } else {
            return null;
        }
    }
}
