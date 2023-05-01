<?php

namespace dmitrybukhonov\adyammy\widgets\factory;

use dmitrybukhonov\adyammy\helpers\AdCompany;

final class AdBlockFactory
{
    public static function create(array $adBlock): AdBlockInterface
    {
        if ($adBlock['company_id'] == AdCompany::ADFOX) {
            return new AdFox($adBlock);
        } elseif ($adBlock['company_id'] == AdCompany::AD_YOUR_BANNER) {
            return new CustomBanner($adBlock);
        } else {
            throw new \InvalidArgumentException('Не верная рекламная');
        }
    }
}
