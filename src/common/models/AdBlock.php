<?php

namespace dmitrybukhonov\adyammy\common\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $position_id
 * @property string|null $ad_code_desktop
 * @property string|null $ad_code_mobile
 * @property string|null $id_banner_scroll_desktop
 * @property string|null $id_banner_scroll_mobile
 * @property string|null $image_desktop
 * @property string|null $image_mobile
 * @property string|null $banner_url_mobile
 * @property string|null $banner_url_desktop
 * @property bool $is_published
 * @property string $created_at
 * @property string $updated_at
 */
class AdBlock extends ActiveRecord
{
    /**
     * @inheritDoc
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%ad_blocks}}';
    }

    /**
     * @return AdBlockQuery
     */
    public static function find(): AdBlockQuery
    {
        return new AdBlockQuery(get_called_class());
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'is_published' => 'Опубликован',
            'company_id' => 'Рекламная компания',
            'position_id' => 'Позиция баннера',
            'ad_code_desktop' => 'Код баннера (Десктоп)',
            'ad_code_mobile' => 'Код рекламы (Мобайл)',
            'id_banner_scroll_desktop' => 'ID баннера для Инфинити скролла (Десктоп)',
            'id_banner_scroll_mobile' => 'ID баннера для Инфинити скролла (Мобайл)',
            'image_desktop_file' => 'Баннер (Десктоп)',
            'image_mobile_file' => 'Баннер (Мобайл)',
            'banner_url_desktop' => 'Ссылка баннера (Десктоп)',
            'banner_url_mobile' => 'Ссылка баннера (Мобайл)',
        ];
    }
}
