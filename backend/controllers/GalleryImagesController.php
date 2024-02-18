<?php

namespace backend\controllers;

use Yii;
use backend\models\GalleryImages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GalleryImagesController implements the CRUD actions for GalleryImages model.
 */
class GalleryImagesController extends Controller
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all GalleryImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GalleryImages::find(),
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $gallery = GalleryImages::find()->all();

        return $this->render('view', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Updates an existing GalleryImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $galleryImages = new GalleryImages();
            if ($galleryImages->imageFiles = UploadedFile::getInstances($model, 'imageFiles')) {
                if ($arrayPath = $galleryImages->getUploads($model->id)) {
                    $model->getDeleteFile($model->original);
                    $model->getDeleteFile($model->resize1);
                    $model->getDeleteFile($model->resize2);
                    $model->getDeleteFile($model->resize3);

                    $model->original = $arrayPath[0];
                    $model->save();
                    $model->getImagineBox($model->id);//Автообрезка
                }
            }

            Yii::$app->session->setFlash('success', 'Сохранено');
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GalleryImages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Изображение удалено.');
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the GalleryImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GalleryImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GalleryImages::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIsMain($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            GalleryImages::updateAll(['is_main' => 0], ['id_model' => $model->id_model, 'marker' => $model->marker]);
            $model->is_main = 1;
            $model->save();
            Yii::$app->session->setFlash('success', 'Гдавное изображение выбрано.');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Оптимизация
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionResize($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $type = Yii::$app->request->get('type');
            if (!empty($type) && !empty($model->{$type})) {
                GalleryImages::getImagineResize($model->{$type});
                Yii::$app->session->setFlash('success', 'Изображение оптимизированно');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
