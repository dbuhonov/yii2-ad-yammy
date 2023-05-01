<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use dmitrybukhonov\adyammy\helpers\AdCompany;
use dmitrybukhonov\adyammy\helpers\AdPosition;
use dmitrybukhonov\adyammy\backend\models\AdBlock;
use dmitrybukhonov\adyammy\backend\assets\AdYammyAsset;

/**
 * @var View $this
 * @var AdBlock $model
 * @var array $adPositionList
 * @var array $adCompanyList
 */

AdYammyAsset::register($this);

$this->title = 'Список баннеров';

?>

<?= Html::beginForm(['adv-setting/index']) ?>

<div class="model-index">
    <div class="body-header">
        <div class="container">
            <?= \yii\widgets\Breadcrumbs::widget([
                'tag' => 'ol',
                'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
                'links' => [$this->title]
            ]) ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-7">
                        <p><?= Html::a('Добавить баннер', ['create'], ['class' => 'btn btn-success']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover table-responsive dataTable no-footer'],
                'columns' => [
                    'name',
                    [
                        'attribute' => 'position_id',
                        'value' => function ($model) {
                            return AdPosition::getPositionName($model->position_id);
                        },
                        'filter' => $adPositionList,
                    ],
                    [
                        'attribute' => 'company_id',
                        'value' => function ($model) {
                            return AdCompany::getCompanyName($model->company_id);
                        },
                        'filter' => $adCompanyList,
                    ],
                    [
                        'attribute' => 'is_published',
                        'value' => function ($model) {
                            return $model->is_published ? 'Опубликовано' : 'Не опубликовано';
                        },
                        'filter' => [1 => 'Опубликовано', 0 => 'Не опубликовано'],
                    ],
                    [
                        'class' => ActionColumn::class,
                        'headerOptions' => ['width' => '150'],
                        'template' => '{update} ',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?= Html::endForm() ?>