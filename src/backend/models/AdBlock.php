<?php

namespace dmitrybukhonov\adyammy\backend\models;

use yii\web\UploadedFile;
use dmitrybukhonov\adyammy\backend\services\ImageService;
use dmitrybukhonov\adyammy\common\models\AdBlock as AdBlockCommon;
use dmitrybukhonov\adyammy\backend\validators\AdFoxBannerIdValidator;

/**
 * @property UploadedFile|null $image_desktop_file
 * @property UploadedFile|null $image_mobile_file
 */
class AdBlock extends AdBlockCommon
{
    public $image_desktop_file;
    public $image_mobile_file;

    /**
     * @inheritDoc
     */
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $imageService = new ImageService();
            $oldImageDesktop = $this->getOldAttribute('image_desktop');
            $oldImageMobile = $this->getOldAttribute('image_mobile');

            if ($this->image_desktop_file instanceof UploadedFile) {
                if (!empty($oldImageDesktop)) {
                    $imageService->delete($this, 'image_desktop');
                }

                $this->image_desktop = $imageService->upload($this, 'image_desktop_file');
            }

            if ($this->image_mobile_file instanceof UploadedFile) {
                if (!empty($oldImageMobile)) {
                    $imageService->delete($this, 'image_mobile_file');
                }

                $this->image_mobile = $imageService->upload($this, 'image_mobile_file');
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function rules(): array
    {
        return [
            [['is_published'], 'boolean'],
            [['company_id', 'position_id'], 'integer'],
            [['name', 'company_id', 'position_id'], 'required'],
            [['banner_url_desktop', 'banner_url_mobile'], 'url'],
            [['image_desktop', 'image_mobile'], 'safe'],
            [['image_desktop_file', 'image_mobile_file'], 'file', 'extensions' => ['jpeg', 'jpg', 'png']],
            [['name', 'banner_url_desktop', 'banner_url_mobile', 'id_banner_scroll_desktop', 'id_banner_scroll_mobile'], 'string', 'max' => 255],
            [
                ['position_id', 'is_published'],
                'unique',
                'targetAttribute' => ['position_id', 'is_published'],
                'message' => 'Для выбранной позиции уже создан опубликованный баннер (Его необходимо скрыть или использовать как активный)',
            ],
            [['ad_code_desktop', 'ad_code_mobile'], 'safe'],
            [['id_banner_scroll_desktop', 'id_banner_scroll_mobile'], AdFoxBannerIdValidator::class],
        ];
    }
}
