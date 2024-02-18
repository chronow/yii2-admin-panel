<?php

use backend\models\GalleryImages;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filter GalleryImages */
/* @var $selectCategory GalleryImages */

$this->title = 'Гелерея';
$this->params['breadcrumbs'][] = $this->title;

$id_category = '';
if (!empty(Yii::$app->request->get('GalleryImagesSearch')['id_model'])) {
    $id_model = Yii::$app->request->get('GalleryImagesSearch')['id_model'];
    $this->title = $selectCategory['title'];
}
?>

<?php //echo $this->render('_search', ['model' => $searchModel, 'filter' => $filter]); ?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_image',
    'itemOptions' => [
        'tag' => false,
    ],
    'options' => [
        'class' => 'row',
        'id' => 'list-wrapper',
    ],
    //'layout' => "{items}\n{pager}",
    'pager' => [
        'options' => [
            'class' => 'pagination',
        ],
        'maxButtonCount' => 15,
        'pageCssClass' => 'page-item p-1',
        'activePageCssClass' => 'active',
        'disabledPageCssClass' => 'disabled',
        'firstPageCssClass' => 'first',
        'prevPageCssClass' => 'p-1',
        'nextPageCssClass' => 'p-1',
    ],
]); ?>
