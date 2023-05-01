<?php

namespace dmitrybukhonov\adyammy;

use Yii;
use yii\base\Module as BaseModule;

/**
 * Модуль управления рекламными баннерами.
 */
class Module extends BaseModule
{
    /**
     * @var string ID приложения, где находится административная часть
     */
    public $backendAppId;

    /**
     * @var string Путь до директории с изображениями баннеров
     */
    public $imagePath;

    /**
     * @var string URL до директории с изображениями баннеров
     */
    public $imageUrl;

    /** 
     * @var array Список позиций для размещения рекламы
     */
    public $adPositionList;
    /** 
     * @var string Путь до директории с шаблонами представления
     */
    public $viewPath;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->backendAppId) {
            throw new \InvalidArgumentException('Свойство $backendAppId должно быть установлено');
        }

        if (!$this->imagePath) {
            throw new \InvalidArgumentException('Свойство $imagePath должно быть установлено');
        }

        if (!$this->imageUrl) {
            throw new \InvalidArgumentException('Свойство $imageUrl должно быть установлено');
        }

        if (!$this->adPositionList) {
            throw new \InvalidArgumentException('Свойство $adPositionList должно быть установлено');
        }

        if (!$this->viewPath) {
            throw new \InvalidArgumentException('Свойство $viewPath должно быть установлено');
        }
    }

    /**
     * @inheritdoc
     */
    public function getViewPath()
    {
        return Yii::getAlias($this->viewPath);
    }
}
