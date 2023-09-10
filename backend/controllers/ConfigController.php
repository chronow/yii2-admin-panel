<?php

namespace backend\controllers;

use common\models\Config;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Config models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Config();
        if ($this->request->isPost) {
            if (!empty($this->request->post('Config')['value'])) {
                foreach ($this->request->post('Config')['value'] as $id => $value) {
                    $model = Config::findOne($id);
                    $model->value = $value;
                    $model->save();
                }
            }
            if (!empty($this->request->post('Config')['file'])) {
                foreach ($this->request->post('Config')['file'] as $id => $value) {
                    $upload = new Config();
                    $upload->file = UploadedFile::getInstance($upload, 'file[' . $id . ']');
                    if ($upload->file && $upload->validate()) {
                        if ($path = $upload->getUpload($id)) {
                            $model = Config::findOne($id);
                            $model->getDeleteFile();
                            $model->value = $path;
                            $model->save();
                        }
                    }
                }
            }
            \Yii::$app->session->setFlash('success', 'Сохранено');
            return $this->redirect(['index', 'tabsType' => $model->tabsType]);
        }
        $config = Config::find()->orderBy(['byOrder' => SORT_DESC, 'group' => SORT_ASC])->all();
        $config = ArrayHelper::index($config, 'id', 'tabsType');
        return $this->render('index', compact('config'));
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Config();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Config::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
