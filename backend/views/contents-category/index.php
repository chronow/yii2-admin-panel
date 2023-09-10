<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ContentsCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContentsCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => 'Контент', 'url' => ['contents/']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body table-responsive" style="font-size:14px">

<?= Html::a('Добавить <i class="bi bi-plus ps-2"></i>', ['create'], ['class' => 'btn btn-block btn-outline-primary btn-sm float-end mb-2']) ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-hover table-striped table-bordered align-middle'],
    'columns' => [
        [
            'label' => 'Записей',
            'headerOptions' => ['style' => 'width:90px;', 'class' => 'text-center'],
            'contentOptions' => [ 'style' => 'font-size:12px', 'class' => 'text-center'],
            'content' => function($data){
                $count = ContentsCategory::getCount( $data->id );
                return ($count > 0) ? Html::a($count, ['/contents/index', 'ContentsSearch[id_contents_category]' => $data->id], ['class' => $count > 0 ? 'text-primary text-bold' : 'text-muted']) : '<a href="/backend/contents/create/?id_contents_category=' . $data->id . '" class="text-muted" title="Добавить запись">0</a>';
            }
        ],
        'title' => [
            'attribute' => 'title',
            'content' => function ($model) {
                $class = 'text-second';
                return '<span class="' . $class . '"><span class="hidden-xs pr-2 pe-2 fa fa-folder' . ( ($model->isFather) ? '-open' : '' ) . '" data-article="' . $model->id . '" style="padding-left:' . ( $model->level * 20 ) . 'px"></span>' . $model->title . '</span>';
            },
        ],
        'isPublic:boolean' => [
            'attribute' => 'isPublic',
            'contentOptions' => ['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center', 'style' => 'width:105px;'],
            'content' => function ($data) {
                if ($data->isPublic) {
                    return '<span class="text-success text-center" style="width:100%">Да</span>';
                }
                return '<span class="text-danger text-center" style="width:100%">Нет</span>';
            },
        ],
        'byOrder' => [
            'attribute' => 'byOrder',
            'label' => '№ п/п',
            'contentOptions' => ['class' => 'text-center'],
            'headerOptions' => ['class' => 'text-center', 'style' => 'width:105px;'],
            'content' => function ($data) {
                return '<span class="text-muted text-center" style="width:100%">' . $data->byOrder . '</span>';
            },
        ],
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width:75px;'],
            'contentOptions' => ['class' => 'text-center'],
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
    </div>
</div>
