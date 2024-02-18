<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body table-responsive" style="font-size:14px">

<?= Html::a('Добавить <i class="bi bi-plus ps-2"></i>', ['create'], ['class' => 'btn btn-block btn-outline-primary btn-sm float-end mb-2']) ?>
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-hover table-striped table-bordered align-middle'],
    'columns' => [
        'id'=>[
            'label' => 'ID',
            'attribute' => 'id',
            'headerOptions' => ['style' => 'text-align:center; width: 75px;'],
            'contentOptions' => [ 'style' => 'text-align:center;vertical-align: middle;' ],
            'content' => function($model){
                return '<span class="text-muted text-center">'.$model->id.'</span>';
            },
        ],
        'username',
        'name',
        'job_title',
        'email:email',
        'phone',
        'type' => [
            'label' => 'Тип',
            'attribute' => 'type',
            'headerOptions' => ['style' => 'text-align:center; width: 155px;'],
            'filterInputOptions' => ['class' => 'form-control form-select'],
            'contentOptions' => [ 'style' => 'text-align:center;vertical-align: middle;' ],
            'content' => function($model){
                return $model->getType();
            },
            'filter' => \common\models\User::$type,
        ],
        'status' => [
            'label' => 'Статус',
            'attribute' => 'status',
            'headerOptions' => ['style' => 'text-align:center; width: 155px;'],
            'filterInputOptions' => ['class' => 'form-control form-select'],
            'contentOptions' => [ 'style' => 'text-align:center;vertical-align: middle;' ],
            'content' => function($model){
                switch ($model->status) {
                    case $model::STATUS_DELETED:
                        $badge = 'badge bg-danger';
                        break;
                    case $model::STATUS_INACTIVE:
                        $badge = 'badge bg-warning';
                        break;
                    case $model::STATUS_ACTIVE:
                        $badge = 'badge bg-success';
                        break;
                    default:
                        $badge = '';
                }

                return '<span class="' . $badge . ' text-black fs-8">' . $model->getStatus() . '</span>';
            },
            'filter' => \common\models\User::$status,
        ],
        //'created_at',
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width:60px'],
            'contentOptions' => ['class' => 'text-center'],
            'template' => '<div class="justify-flex">{update} {delete}</div>',
        ],
    ],
]); ?>
<?php Pjax::end(); ?>

        </div>
</div>
