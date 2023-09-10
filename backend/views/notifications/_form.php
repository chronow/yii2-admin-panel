<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\Notifications */
/* @var $form yii\widgets\ActiveForm */

$card = ($model->isNewRecord) ? 'card-primary' : 'card-warning';
$btn = ($model->isNewRecord) ? 'btn-primary' : 'btn-warning';
?>

<?php $form = ActiveForm::begin(); ?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline <?= $card ?>">
            <div class="card-header">
                <h3 class="card-title float-left float-start mt-1"><?= ($model->isNewRecord) ? 'Добавить запись' :'Редактирование: #' . $model->id ?></h3>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-end waves-effect waves-light ' . $btn]) ?>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6 g-3">
                        <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-6 g-3">
                        <?= $form->field($model, 'status')->dropDownList($model->getStatus(), ['class' => 'form-control form-select']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 g-3"><?= $form->field($model, 'phone')->textInput(['maxlength' => true])->widget(MaskedInput::class, [
                            'mask' => '+9 (999) 999-99-99', 'options' => ['placeholder' => '+X (XXX) XXX-XX-XX']
                        ]) ?></div>

                    <div class="col-6 g-3"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
                </div>

                <div class="row">
                    <div class="col-12 g-3">
                        <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-start waves-effect waves-light ' . $btn]) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>