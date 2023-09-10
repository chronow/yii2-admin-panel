<?php

namespace backend\controllers;

use Yii;
use common\models\ContentsCategory;
use backend\models\ContentsCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentsCategoryController implements the CRUD actions for ContentsCategory model.
 */
class ContentsCategoryController extends Controller
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
     * Lists all ContentsCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentsCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['sorting'=> SORT_ASC,'idParent'=>SORT_DESC]]);
        $dataProvider->pagination->pageSize=500;

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Creates a new ContentsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentsCategory();

        if ($model->load(Yii::$app->request->post())) {
            //Поиск отца по id
            $model->level = 1;
            $model->isFather = 0;
            if ($parent = $model->findOne($model->idParent)) {
                $model->level = $parent->level + 1 ?? 1;
                $model->gr = $parent->gr;
                if (!$parent->isFather) {
                    $parent->isFather = 1;
                    $parent->save();
                }
            }
            if ($model->save()) {
                if (empty($model->key)) {
                    $model->key = 'key-' . $model->id;
                    $model->save();
                }
                $model->getCategorySort();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Сохранено'));
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing ContentsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //Поиск отца по id
            $model->level = 1;
            if ($parent = $model->findOne($model->idParent)) {
                $model->level = $parent->level + 1; //Увеличиваем у наследника уровень вложенности на +1 от отца
                $model->gr = $parent->gr;
                if (!$parent->isFather) {//Если отец был child, то ставим ему тип father
                    $parent->isFather = 1;
                    $parent->save();
                }
            }
            if ($model->save()) {
                if (empty($model->key)) {
                    $model->key = 'key-' . $model->id;
                    $model->save();
                }
                $model->getCategorySort();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Сохранено'));
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing ContentsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            //Обновляем у всех наследников параметр level-1
            ContentsCategory::getUpdateLevelRec($model->id);
            //Всем детям которые следуют сразу за родителем, присваиваем родителя который выше вместо удаляемого
            $updateAll = ContentsCategory::updateAll(['idParent' => $model->idParent], ['idParent' => $model->id]);
            //Если наследников нет, то вышестоящему родителю присваиваем child вместо father
            if ($updateAll == 0 && $model->idParent > 0) {
                $parent = $this->findModel($model->idParent);
                if ($parent->isFather) {
                    $parent->isFather = 0;
                    $parent->save();
                }
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Запись удалена');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ContentsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentsCategory::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
