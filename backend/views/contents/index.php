<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use common\models\ContentsCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $contentsCategory common\models\ContentsCategory */

$this->title = 'Контент';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body table-responsive" style="font-size:14px">

<?= Html::a('Добавить <i class="bi bi-plus ps-2"></i>', ['create'], ['class' => 'btn btn-block btn-outline-primary btn-sm float-end mb-2']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-hover table-striped table-bordered align-middle'],
    'columns' => [
        'key' => [
            'label' => 'Ключ',
            'attribute' => 'key',
            'headerOptions' => ['style' => 'width:160px', 'class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'content' => function ($model) {
                return (!empty($model->key)) ? '<span class="badge bg-danger font-14 rounded-pill pl-2 pr-2">' . $model->key . '</span>' : '<code>«ключ не указан»</code>';
            },
        ],
        'id_contents_category' => [
            'attribute' => 'id_contents_category',
            'content' => function ($data) {
                return (!empty($data->contentsCategory->title)) ? '<i class="fe-folder pr-2"></i>' . $data->contentsCategory->title : 'не выбрано' ;
            },
            'filter' => ContentsCategory::getDropDownList(),
        ],
        'title' => [
            'label' => 'Название',
            'attribute' => 'title',
        ],
        'isPublic' => [
            'attribute' => 'isPublic',
            'contentOptions' => ['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center', 'style' => 'width:105px'],
            'content' => function ($data) {
                if ($data->isPublic) {
                    return '<span class="pull-left text-success text-center" style="width:100%">Да</span>';
                }
                return '<span class="pull-left text-danger text-center" style="width:100%">Нет</span>';
            },
            'filter' => [0 => 'Нет', 1 => 'Да'],
        ],
        'byOrder' => [
            'attribute' => 'byOrder',
            'label' => '№ п/п',
            'contentOptions' => ['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center', 'style' => 'width:75px;'],
            'content' => function ($data) {
                return '<span class="pull-left text-muted text-center" style="width:100%">' . $data->byOrder . '</span>';
            },
        ],
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width:60px'],
            'contentOptions' => ['class' => 'text-center'],
            'template' => '<div class="justify-flex">{update} {delete}</div>',
        ],
    ],
]); ?>
    </div>
</div>
