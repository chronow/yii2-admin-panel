<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title float-left float-start pt-1 font-16">
            <?php if (!$model->isNewRecord): ?>
                <i class="fa fa-hashtag pr-2"></i><?= $model->id ?>
            <?php endif; ?>
        </h3>
        <?= Html::submitButton('Сохранить <i class="fa fa-save pl-2"></i>', ['class' => 'btn btn-sm btn-success float-end']) ?>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'group')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'key')->textInput(['maxlength' => true, 'placeholder' => 'key']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'byOrder')->textInput() ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'type')->dropDownList([ 'string' => 'String', 'boolean' => 'Boolean', 'number' => 'Number', 'file' => 'File', 'password' => 'Password', 'date' => 'Date'], ['class' => 'form-control form-select']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'tabsType')->dropDownList($model::$type, ['class' => 'form-control form-select']) ?>
            </div>

            <div class="col-md-12">
                <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
            </div>


        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('<i class="fa fa-save pr-2"></i> Сохранить', ['class' => 'btn btn-sm btn-success waves-effect waves-light']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

