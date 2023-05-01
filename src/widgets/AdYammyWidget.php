<?php

namespace dmitrybukhonov\adyammy\widgets;

use yii\base\Widget;
use dmitrybukhonov\adyammy\widgets\factory\AdBlockFactory;
use dmitrybukhonov\adyammy\widgets\repository\AdYammyRepository;

class AdYammyWidget extends Widget
{
    /**
     * @var int
     */
    public $positionId;

    /**
     * @inheritDoc
     */
    public function beforeRun(): bool
    {
        if (!parent::beforeRun()) {
            return false;
        }

        if (empty($this->positionId)) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function run(): string
    {
        $adYammyRepository = new AdYammyRepository();
        $adBlock = $adYammyRepository->getAdByPositionQuery($this->positionId)->asArray()->one();

        if (!$adBlock) {
            return '';
        }

        $banner = AdBlockFactory::create($adBlock);

        return $this->render($banner->getView(), [
            'banner' => $banner,
        ]);
    }
}
