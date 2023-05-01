<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use kartik\editors\Codemirror;
use dmitrybukhonov\adyammy\helpers\ImageHelper;
use dmitrybukhonov\adyammy\backend\models\AdBlock;
use kartik\editors\assets\CodemirrorAsset;
use dmitrybukhonov\adyammy\backend\assets\AdYammyAsset;

/**
 * @var View $this
 * @var AdBlock $model
 * @var array $companyList
 * @var array $positionList
 */

AdYammyAsset::register($this);
CodemirrorAsset::register($this);

$this->registerJs('AdYammy.init()');

$this->title = 'Редактирование рекламного блока';

$form = ActiveForm::begin([
    'id' => 'article-form',
    'options' => [
        'class' => 'row',
        'enctype' => 'multipart/form-data'
    ],
    'enableAjaxValidation' => true,
]);

?>

<div class="col-lg-8">
    <div class="card card-default">
        <div class="card-body">
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'is_published')->checkbox() ?>
            <?= $form->field($model, 'position_id')->dropDownList($positionList) ?>
            <?= $form->field($model, 'company_id')->dropDownList($companyList, ['class' => 'form-control js-company-select']) ?>
            <?= $form->field($model, 'image_desktop_file', ['options' => ['class' => 'js-image-desktop']])->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'data-delete-url' => Url::to(['adv-setting/delete-image', 'id' => $model->id, 'attribute' => 'image_desktop']),
                    'class' => 'js-file-input-image'
                ],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpeg', 'jpg', 'png'],
                    'showUpload' => false,
                    'showRemove' => false,
                    'initialPreview' => [
                        ImageHelper::getUrl($model->image_desktop)
                    ],
                    'initialPreviewConfig' => [
                        [
                            'showRemove' => false,
                            'showDrag' => false,
                        ],
                    ],
                    'initialPreviewAsData' => true,
                ],
            ]) ?>
            <?= $form->field($model, 'banner_url_desktop', ['options' => ['class' => 'js-url']]) ?>
            <?= $form->field($model, 'image_mobile_file', ['options' => ['class' => 'js-image-mobile']])->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'data-delete-url' => Url::to(['adv-setting/delete-image', 'id' => $model->id, 'attribute' => 'image_mobile']),
                    'class' => 'js-file-input-image'
                ],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpeg', 'jpg', 'png'],
                    'showUpload' => false,
                    'showRemove' => false,
                    'initialPreview' => [
                        ImageHelper::getUrl($model->image_mobile)
                    ],
                    'initialPreviewConfig' => [
                        [
                            'showRemove' => false,
                            'showDrag' => false,
                        ],
                    ],
                    'initialPreviewAsData' => true,
                ],
            ]) ?>
            <?= $form->field($model, 'banner_url_mobile', ['options' => ['class' => 'js-url']]) ?>

            <?= $form->field($model, 'ad_code_desktop', ['options' => ['class' => 'js-adcode-desktop']])->widget(Codemirror::class, [
                'toolbar' => [],
            ]) ?>
            <?= $form->field($model, 'id_banner_scroll_desktop', ['options' => ['class' => 'js-banner-scroll-desktop']]) ?>

            <?= $form->field($model, 'ad_code_mobile', ['options' => ['class' => 'js-adcode-mobile']])->widget(Codemirror::class, [
                'toolbar' => [],
            ]) ?>
            <?= $form->field($model, 'id_banner_scroll_mobile', ['options' => ['class' => 'js-banner-scroll-mobile']]) ?>

            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px;']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>