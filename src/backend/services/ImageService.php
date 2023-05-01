<?php

namespace dmitrybukhonov\adyammy\backend\services;

use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use dmitrybukhonov\adyammy\backend\models\AdBlock;

final class ImageService
{
    /**
     * Загрузка нового изображения
     * 
     * @param AdBlock $adBlock
     * @param mixed $attribute
     * @return bool
     */
    public function upload(AdBlock $adBlock, $attribute): string
    {
        $image = $adBlock->$attribute;

        $imagePath = Yii::getAlias('@adyammy.imagePath/');
        FileHelper::createDirectory($imagePath);

        $imageName = Yii::$app->security->generateRandomString() . '.' . $image->getExtension();
        if (!$image->saveAs($imagePath . $imageName)) {
            throw new Exception('Ошибка при загрузке изображения');
        }

        return $imageName;
    }

    /**
     * Удаление старого изображения при загрузке нового
     * 
     * @param AdBlock $adBlock
     * @param mixed $attribute
     * @return bool
     */
    public function delete(AdBlock $adBlock, $attribute): bool
    {
        $image = $adBlock->$attribute;
        if (!$image) {
            return true;
        }

        $imagePath = Yii::getAlias('@adyammy.imagePath/' . $image);
        if (is_file($imagePath) && file_exists($imagePath)) {
            unlink($imagePath);

            return true;
        }

        return false;
    }

    /**
     * Удаление изображения с виджета FileInput с обновлением
     * 
     * @param AdBlock $adBlock
     * @param mixed $attribute
     * @return bool
     */
    public function deleteFileInput(AdBlock $adBlock, $attribute): bool
    {
        $image = $adBlock->$attribute;
        if (!$image) {
            return true;
        }

        $imagePath = Yii::getAlias('@adyammy.imagePath/');
        $imageFile = $imagePath . $image;

        if (is_file($imageFile) && file_exists($imageFile)) {
            unlink($imageFile);
        }

        $adBlock->$attribute = null;

        return $adBlock->save(false, [$attribute]);
    }
}
