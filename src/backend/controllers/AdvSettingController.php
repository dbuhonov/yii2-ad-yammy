<?php

namespace dmitrybukhonov\adyammy\backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use dmitrybukhonov\adyammy\helpers\AdCompany;
use dmitrybukhonov\adyammy\helpers\AdPosition;
use dmitrybukhonov\adyammy\backend\models\AdBlock;
use dmitrybukhonov\adyammy\backend\models\AdBlockSearch;
use dmitrybukhonov\adyammy\backend\services\ImageService;

class AdvSettingController extends Controller
{
    private $adPositionList;
    private $imageService;

    public function __construct($id, $module, ImageService $imageService, $config = [])
    {
        $this->imageService = $imageService;
        $this->adPositionList = Yii::$app->getModule('adyammy')->adPositionList;

        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = new AdBlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'adPositionList' => $this->adPositionList,
            'adCompanyList' => AdCompany::getAll(),
        ]);
    }

    public function actionCreate()
    {
        $model = new AdBlock();

        return $this->proceedModel($model);
    }

    public function actionUpdate(int $id)
    {
        /** @var AdBlock */
        $model = AdBlock::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Статья не найдена');
        }

        return $this->proceedModel($model);
    }

    /**
     * Обрабатывает создание и редактирование статьи.
     */
    private function proceedModel(AdBlock $model)
    {
        $request = Yii::$app->request;
        $isAjax = $request->isAjax;

        if ($isAjax && $model->load($request->post())) {
            return $this->asJson(ActiveForm::validate($model));
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->image_desktop_file = UploadedFile::getInstance($model, 'image_desktop_file');
            $model->image_mobile_file = UploadedFile::getInstance($model, 'image_mobile_file');

            if ($model->validate() && $model->save()) {
                return $this->redirect(Url::to(['/adyammy/adv-setting/update', 'id' => $model->id]));
            }
        }

        return $this->render('model', [
            'model' => $model,
            'companyList' => AdCompany::getAll(),
            'positionList' => AdPosition::getAll(),
        ]);
    }

    public function actionDeleteImage(int $id, string $attribute)
    {
        /** @var AdBlock */
        $adBlock = AdBlock::findOne($id);

        if (!$adBlock) {
            throw new NotFoundHttpException('Материал не найден');
        }

        $this->imageService->deleteFileInput($adBlock, $attribute);
    }
}
