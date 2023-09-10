<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\GalleryImages;
use backend\models\ContentsSearch;
use common\models\ContentsCategory;
use common\models\Contents;

use yii\web\UploadedFile;

/**
 * ContentsController implements the CRUD actions for Contents model.
 */
class ContentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $contentsCategory = ContentsCategory::find()->all();

        return $this->render('index', compact('searchModel', 'dataProvider', 'contentsCategory'));
    }

    /**
     * Creates a new Contents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contents();
        $category = ContentsCategory::find()->all();
        $galleryImages = new GalleryImages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (empty($model->key)) $model->key = 'key-' . $model->id;
            $model->update();

            //Главная обложка
            if ($galleryImages->imageFiles = UploadedFile::getInstances($model, 'mainImage')) {
                if ($arrayPath = $galleryImages->getUploads($model->id)) {
                    GalleryImages::deleteAll(['id_model' => $model->id, 'marker' => Yii::$app->controller->id]);
                    $images = new GalleryImages();
                    $images->is_main = 1;
                    $images->id_model = $model->id;
                    $images->marker = Yii::$app->controller->id;
                    $images->title = $model->title;
                    $images->original = $arrayPath[0];
                    $images->save();
                    $images->getImagineBox($images->id);//Автообрезка
                }
            }
            //Галерея
            if ($galleryImages->imageFiles = UploadedFile::getInstances($model, 'imageFiles')) {
                if ($arrayPath = $galleryImages->getUploads($model->id)) {
                    foreach ($arrayPath as $path) {
                        $images = new GalleryImages();
                        $images->is_main = 0;
                        $images->id_model = $model->id;
                        $images->marker = Yii::$app->controller->id;
                        $images->title = $model->title;
                        $images->original = $path;
                        $images->save();
                        $images->getImagineBox($images->id);//Автообрезка
                    }
                }
            }
            Yii::$app->session->setFlash('success', 'Запись добавлена');
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('create', compact('model', 'category'));
    }

    /**
     * Updates an existing Contents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $galleryImages = new GalleryImages();

        //Для выпадающего dropDownList (выбор категории)
        $category = ContentsCategory::find()->all();

        //Главная обложка + галерея
        $mainImage = GalleryImages::find()->where(['id_model' => $model->id, 'marker' => Yii::$app->controller->id, 'is_main' => 1])->one();
        $gallery = GalleryImages::find()
            ->where(['id_model' => $model->id, 'marker' => Yii::$app->controller->id, 'is_main' => 0])
            ->orderBy(['order_image' => SORT_ASC])
            ->all();

        //Для выпадающего dropDownList (Связь с записью)
        $allContents = [];
        $array = Contents::find()->andWhere(['<>', 'id', $model->id])->asArray()->all();
        if ($array) foreach ($array as $item) $allContents[$item['id']] = (($item['title'] != '') ? $item['title'] : '«не указано»') . (($item['key'] != '') ? '  [' . $item['key'] . ']' : '') ;

        if ($model->load(Yii::$app->request->post()) ) {
            if (empty($model->published)) {
                $model->published = time();
            } else {
                $model->published = strtotime($model->published);
            }
            $model->save();

            //Главная обложка
            if ($galleryImages->imageFiles = UploadedFile::getInstances($model, 'mainImage')) {
                if ($arrayPath = $galleryImages->getUploads($model->id)) {
                    GalleryImages::deleteAll(['id_model' => $model->id, 'marker' => Yii::$app->controller->id]);
                    $images = new GalleryImages();
                    $images->is_main = 1;
                    $images->id_model = $model->id;
                    $images->marker = Yii::$app->controller->id;
                    $images->title = $model->title;
                    $images->original = $arrayPath[0];
                    $images->save();
                    $images->getImagineBox($images->id);//Автообрезка
                }
            }
            //Галерея
            if ($galleryImages->imageFiles = UploadedFile::getInstances($model, 'imageFiles')) {
                if ($arrayPath = $galleryImages->getUploads($model->id)) {
                    foreach ($arrayPath as $path) {
                        $images = new GalleryImages();
                        $images->is_main = 0;
                        $images->id_model = $model->id;
                        $images->marker = Yii::$app->controller->id;
                        $images->title = $model->title;
                        $images->original = $path;
                        $images->save();
                        $images->getImagineBox($images->id);//Автообрезка
                    }
                }
            }
            Yii::$app->session->setFlash('success', 'Запись сохранена');
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('update', compact('model', 'mainImage', 'gallery', 'category', 'allContents'));
    }

    /**
     * Deletes an existing Contents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Запись удалена');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Contents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contents::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
