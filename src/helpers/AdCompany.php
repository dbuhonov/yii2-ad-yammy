<?php

namespace dmitrybukhonov\adyammy\helpers;

use yii\helpers\ArrayHelper;

final class AdCompany
{
    const ADFOX = 1;
    const AD_YOUR_BANNER = 2;

    public static function getAll(): array
    {
        return [
            self::ADFOX => 'Яндекс ADFOX',
            self::AD_YOUR_BANNER => 'Свой баннер',
        ];
    }

    public static function getCompanyName(int $companyId): string
    {
        return ArrayHelper::getValue(self::getAll(), $companyId, '');
    }
}
