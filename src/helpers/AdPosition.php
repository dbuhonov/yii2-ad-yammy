<?php

namespace dmitrybukhonov\adyammy\helpers;

use yii\helpers\ArrayHelper;

class AdPosition
{
    const DISPLAY_MIDDLE_HOME_PAGE_ID = 1;
    const DISPLAY_START_PAGE_AFTER_SCROLL_ID = 2;
    const DISPLAY_ARTICLE_DETAIL_FOOTER_ID = 3;

    public static function getAll(): array
    {
        return [
            self::DISPLAY_MIDDLE_HOME_PAGE_ID => 'В середине страницы (Главная)',
            self::DISPLAY_START_PAGE_AFTER_SCROLL_ID => 'В начале странице при скролле (Cквозной)',
            self::DISPLAY_ARTICLE_DETAIL_FOOTER_ID => 'В футере (Детальной статей)',
        ];
    }

    public static function getPositionName(int $positionId): string
    {
        return ArrayHelper::getValue(self::getAll(), $positionId, '');
    }
}
