<?php

namespace dmitrybukhonov\adyammy\backend\validators;

use yii\validators\Validator;
use dmitrybukhonov\adyammy\helpers\AdCompany;
use dmitrybukhonov\adyammy\backend\models\AdBlock;

class AdFoxBannerIdValidator extends Validator
{
    /**
     * @param AdBlock $model
     * @param mixed $attribute
     * @return void
     */
    public function validateAttribute($model, $attribute)
    {
        if ((int)$model->company_id === AdCompany::ADFOX) {
            $this->validateAdfoxInfinityScrollBannerIdForDesktop($model);
            $this->validateAdfoxInfinityScrollBannerIdForMobile($model);
        }
    }

    private function validateAdfoxInfinityScrollBannerIdForDesktop($model): void
    {
        if (!empty($model->id_banner_scroll_desktop)) {
            if (stripos($model->ad_code_desktop, $model->id_banner_scroll_desktop) === false) {
                $this->addError($model, 'id_banner_scroll_desktop', 'ID баннера для Инфинити скролла должен присутсововать в рекламном скрипте');
            }
        }
    }

    private function validateAdfoxInfinityScrollBannerIdForMobile($model): void
    {
        if (!empty($model->id_banner_scroll_mobile)) {
            if (stripos($model->ad_code_mobile, $model->id_banner_scroll_mobile) === false) {
                $this->addError($model, 'id_banner_scroll_mobile', 'ID баннера для Инфинити скролла должен присутсововать в рекламном скрипте');
            }
        }
    }
}
