<?php

namespace dmitrybukhonov\adyammy\widgets\factory;

use Yii;
use dmitrybukhonov\adyammy\widgets\factory\AdBlockInterface;

final class AdFox implements AdBlockInterface
{
    protected $isMobile;
    protected $positionId;
    protected $ad_code_desktop;
    protected $ad_code_mobile;
    protected $id_banner_scroll_desktop;
    protected $id_banner_scroll_mobile;

    public function __construct(array $adBlock)
    {
        $this->isMobile = Yii::$app->userDevice->isMobile();
        $this->ad_code_desktop = $adBlock['ad_code_desktop'];
        $this->ad_code_mobile = $adBlock['ad_code_mobile'];
        $this->id_banner_scroll_desktop = $adBlock['id_banner_scroll_desktop'];
        $this->id_banner_scroll_mobile = $adBlock['id_banner_scroll_mobile'];
        $this->positionId = $adBlock['position_id'];
    }

    public function getView(): string
    {
        return 'adfox-banner';
    }

    public function getPositionId(): int
    {
        return $this->positionId;
    }

    public function getCode(): ?string
    {
        $code = $this->isMobile ? $this->ad_code_mobile : $this->ad_code_desktop;

        if (!$code) {
            return null;
        }

        return str_replace($this->getIdBannerScroll(), $this->getIdBannerScroll() . '_' . rand(1, 100), $code);
    }

    public function getIdBannerScroll(): ?string
    {
        $idBannerScroll = $this->isMobile ? $this->id_banner_scroll_mobile : $this->id_banner_scroll_desktop;

        if (!$idBannerScroll) {
            return null;
        }

        return $idBannerScroll;
    }
}
