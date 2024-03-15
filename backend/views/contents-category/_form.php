<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ContentsCategory;

/* @var $this yii\web\View */
/* @var $model common\models\ContentsCategory */
/* @var $form yii\widgets\ActiveForm */

$card = ($model->isNewRecord) ? 'card-primary' : 'card-warning';
$btn = ($model->isNewRecord) ? 'btn-primary' : 'btn-warning';
?>

<?php $form = ActiveForm::begin(); ?>
<div class="card card-outline <?= $card ?>">
    <div class="card-header">
        <h3 class="card-title float-left float-start mt-1"><?= ($model->isNewRecord) ? 'Добавить запись' :'Редактирование: #' . $model->id ?></h3>
        <?= Html::submitButton( 'Сохранить ', ['class' => 'btn btn-sm float-end waves-effect waves-light ' . $btn]) ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-8 g-3">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4 g-3">
                            <?= $form->field($model, 'byOrder')->textInput() ?>
                        </div>
                        <div class="col-md-12 g-3">
                            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <?
                        //$items = \yii\helpers\ArrayHelper::map(ContentsCategory::find()->where(['<>', 'id', $model->id ?? 0])->all(),'id','title');
                        $items = ContentsCategory::getDropDownList();
                        if ($model->id > 0) {
                            unset($items[$model->id]);
                        }
                        ?>
                        <div class="col-md-6 g-3">
                            <?= $form->field($model, 'idParent')->dropDownList($items, ['prompt' => 'Выберите родительскую категорию..', 'class' => 'form-control form-select'])?>
                        </div>
                        <div class="col-md-6 pt-4 g-3 text-center">
                            <?php if ($model->isNewRecord): ?>
                                <?= $form->field($model, 'isPublic')->checkbox(['checked' => true]) ?>
                            <?php else: ?>
                                <?= $form->field($model, 'isPublic')->checkbox() ?>
                            <?php endif; ?>
                        </div>
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
