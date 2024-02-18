<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уведомления';
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
        'fio' => [
            'label' => 'Имя',
            'attribute' => 'text',
            'content' => function ($model) {
                return $model->fio;
            },
        ],
        'phone' => [
            'label' => 'Телефон',
            'attribute' => 'text',
            'content' => function ($model) {
                return $model->phone;
            },
        ],
        'email:email' => [
            'label' => 'Email',
            'attribute' => 'text',
            'content' => function ($model) {
                return $model->email;
            },
        ],
        'text' => [
            'label' => 'Сообщение',
            'attribute' => 'text',
            'content' => function ($model) {
                return StringHelper::truncate($model->text, 200);
            },
        ],
        'status' => [
            'headerOptions' => ['class' => 'text-center'],
            'contentOptions' => ['class' => 'text-center'],
            'filterInputOptions' => ['class' => 'form-control form-select'],
            'attribute' => 'status',
            'format' => 'html',
            'content' => function ($model) {
                switch ($model->status) {
                    case 0:
                        $class = 'badge bg-warning text-dark';
                        break;
                    case 1:
                        $class = 'badge bg-secondary';
                        break;
                    case 2:
                        $class = 'badge bg-success';
                        break;
                    default:
                        $class = 'badge bg-secondary';
                }
                return '<sapn class="' . $class . '">' . $model->getStatus($model->status) . '</sapn>';
            },
            'filter' => $searchModel->getStatus(),
        ],
        'created_at' => [
            'headerOptions' => ['class' => 'text-center', 'style' => 'width:145px;'],
            'contentOptions' => ['class' => 'text-center'],
            'attribute' => 'created_at',
            'format' => 'html',
            'content' => function ($model) {
                return Yii::$app->formatter->asDatetime($model->created_at, "php:Y-m-d");
            },
//            'filter' => DatePicker::widget([
//                'model' => $searchModel,
//                'attribute' => 'created_at',
//                'language' => 'ru',
//                'dateFormat' => 'yyyy-MM-dd',
//                'options' => ['class' => 'form-control text-center', 'placeholder' => 'гггг-мм-дд'],
//            ]),

            'filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'created_at',
                'type' => DatePicker::TYPE_INPUT,
                'options' => [
                        'class' => 'text-center',
                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]),
        ],
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'width:90px;'],
            'contentOptions' => ['class' => 'text-center'],
            'template' => '<div class="justify-flex">{update} {view} {delete}</div>',
        ],
    ],
]); ?>
    </div>
</div>
