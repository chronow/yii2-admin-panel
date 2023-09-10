<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$card = ($model->isNewRecord) ? 'card-primary' : 'card-warning';
$btn = ($model->isNewRecord) ? 'btn-primary' : 'btn-warning';
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="card card-outline <?= $card ?>">
        <div class="card-header">
            <h3 class="card-title float-left float-start mt-1"><?= ($model->isNewRecord) ? 'Добавить запись' :'Редактирование: #' . $model->id ?></h3>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-end waves-effect waves-light ' . $btn]) ?>
        </div>
        <div class="card-body">
            <div class="row pb-4">
                <div class="col-lg-3 text-center g-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80%" fill="currentColor" class="bi bi-person-circle text-muted" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 g-3">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-lg-4 col-md-6 g-3">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-lg-4 col-md-6 g-3">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="col-lg-4 col-md-6 g-3">
                        <?= $form->field($model, 'status')->dropDownList($model::$status, ['class' => 'form-control form-select']) ?>
                        </div>

                        <div class="col-lg-8 col-md-6 g-3">
                            <?= $form->field($model, 'job_title')->textInput() ?>
                        </div>

                        <div class="col-lg-4 col-md-4 g-3">
                            <?= $form->field($model, 'type')->dropDownList($model::$type, ['class' => 'form-control form-select']) ?>
                        </div>

                        <div class="col-lg-4 col-md-4 g-3">
                            <?= $form->field($model, 'password')->textInput() ?>
                        </div>

                        <div class="col-lg-4 col-md-4 g-3">
                            <?= $form->field($model, 'password2')->textInput() ?>
                        </div>

                        <div class="col-lg-12 g-3">
                            <?= $form->field($model, 'comment')->textInput() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-start waves-effect waves-light ' . $btn]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
