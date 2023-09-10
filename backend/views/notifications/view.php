<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notifications */

$this->title = 'Просмотр';
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Просмотр #' . $model->id;
?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Сообщение # <?= $model->id ?>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">Статус:</small>
                        <h4 class="mt-0"><?= $model->getStatus($model->status); ?></h4>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-6">
                        <small class="text-muted">Фио:</small>
                        <h4 class="mt-0"><?= $model->fio; ?></h4>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Дата:</small>
                        <h5 class="mt-0"><?= Yii::$app->formatter->asDatetime($model->created_at); ?></h5>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-6">
                        <small class="text-muted">Email:</small>
                        <h5 class="mt-0"><?= !empty($model->email) ? $model->email : 'не указан'; ?></h5>
                    </div>

                    <div class="col-md-6">
                        <small class="text-muted">Телефон:</small>
                        <h5 class="mt-0"><?= !empty($model->phone) ? $model->phone : 'не указан'; ?></h5>
                    </div>
                </div>

                <div class="row pt-2 pb-4">
                    <div class="col-md-12">
                        <small class="text-muted">Сообщение:</small>
                        <h5 class="mt-0"><?= !empty($model->text) ? $model->text : 'не указано'; ?></h5>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::a('<span class="btn-label"><i class="fas fa-trash-alt"></i></span>Удалить', ['delete', 'id' => $model->id], ['class' => 'float-left float-start btn btn-sm btn-secondary waves-effect waves-light', 'data-method' => 'post', 'onclick' => "return window.confirm('Вы точно хотите Удалить?');"]) ?>
            </div>
        </div>
    </div>
</div>