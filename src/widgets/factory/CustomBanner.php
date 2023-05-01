<?php

namespace dmitrybukhonov\adyammy\widgets\factory;

use dmitrybukhonov\adyammy\helpers\ImageHelper;
use Yii;

final class CustomBanner implements AdBlockInterface
{
    protected $positionId;
    protected $title;
    protected $image_mobile;
    protected $image_desktop;
    protected $banner_url_desktop;
    protected $banner_url_mobile;
    protected $isMobile;

    public function __construct(array $adBlock)
    {
        $this->isMobile = Yii::$app->userDevice->isMobile();

        $this->title = $adBlock['name'];
        $this->banner_url_desktop = $adBlock['banner_url_desktop'];
        $this->banner_url_mobile = $adBlock['banner_url_mobile'];
        $this->positionId = $adBlock['position_id'];

        if ($adBlock['image_mobile']) {
            $this->image_mobile = ImageHelper::getUrl($adBlock['image_mobile']);
        }

        if ($adBlock['image_desktop']) {
            $this->image_desktop = ImageHelper::getUrl($adBlock['image_desktop']);
        }
    }

    public function getView(): string
    {
        return 'custom-banner';
    }

    public function getPositionId(): int
    {
        return $this->positionId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImageClass(): string
    {
        return $this->isMobile ? 'bns-mobile' : 'bns-desktop';
    }

    public function getImageUrl(): ?string
    {
        return $this->isMobile ? $this->image_mobile : $this->image_desktop;
    }

    public function getBannerUrl(): string
    {
        return $this->isMobile ? $this->banner_url_mobile : $this->banner_url_desktop;
    }
}
