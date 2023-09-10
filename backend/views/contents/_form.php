<?php

use common\models\ContentsCategory;
use kartik\date\DatePicker;
use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contents */
/* @var $form yii\widgets\ActiveForm */
/* @var $category common\models\ContentsCategory */
/* @var $gallery backend\models\GalleryImages */

$card = ($model->isNewRecord) ? 'card-primary' : 'card-warning';
$btn = ($model->isNewRecord) ? 'btn-primary' : 'btn-warning';
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-lg-3 col-md-5 col-sm-5">
        <div class="card card-outline <?= $card ?>">
            <div class="card-header">
                <h3 class="card-title float-start pt-1">Главная обложка</h3>
            </div>
            <div class="product-box">
                <?php if (!empty($mainImage->resize2)): ?>
                    <div class="float-end position-relative text-center w-100">
                        <div class="product-action">
                            <?= Html::a('<i class="bi bi-pencil"></i>', ['/gallery-images/update', 'id' => $mainImage->id], ['title' => 'Редактировать', 'target' => '_blank', 'class' => 'btn btn-success btn-sm waves-effect waves-light']); ?>
                            <?= Html::a('<i class="bi bi-x-lg"></i>', ['/gallery-images/delete', 'id' => $mainImage->id], ['title' => 'Удалить', 'class' => 'btn btn-danger btn-sm waves-effect waves-light', 'data-method' => 'post', 'onclick' => "return window.confirm('Вы точно хотите Удалить?');"]); ?>
                        </div>
                        <?= Html::img($mainImage->resize2, ['class' => 'card-img', 'loading' => 'lazy']) ?>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <?= $form->field($model, 'mainImage', [
                            'options' => ['tag' => false],
                            'template' => "<div class='font-14'>{label}\n{input}\n{hint}\n{error}</div>"
                        ])->fileInput(['multiple' => false, 'accept' => 'image/*', 'data-plugins' => 'dropify', 'class' => 'form-control dropify form-control-file'])->label(false); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="info-box bg-warning mt-3 mb-3 fs-7" role="alert">
            <div class="info-box-icon"><i class="fa fa-exclamation"></i></div>
            <div class="info-box-content">
                <span>Важно! Перед загрузкой заранее обрабатывайте и приводите их к нужному виду (размер, вес)</span>
            </div>
        </div>

        <div class="alert alert-success fs-7" role="alert">
            <span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;&nbsp;Идеальные параметры обработанного
            изображения:<br/>
            <ul>
                <li>квадратное изображение<br>
                    размер 1200x1200px, 800x800 (пропорция 1x1)</li>
                <li>горизонтальное изображение<br>
                    размер 1600x1200px, 800x600 (пропорция 3x4)</li>
                <li>не превышающий вес более 300 Кб.</li>
            </ul>
        </div>

        <div class="card card-outline <?= $card ?>">
        <div class="card-header">
            <?= $form->field($model, 'imageFiles[]', [
                'options' => ['tag' => false],
                'template' => "<div class='font-14'>{label}\n{input}\n{hint}\n{error}</div>"
            ])->fileInput(['multiple' => true, 'accept' => 'image/*', 'class' => 'form-control form-control-file']); ?>
        </div>
        </div>
        <?= $this->render('/gallery-images/view', compact('mainImage', 'gallery')); ?>
    </div>

    <div class="col-lg-9 col-md-8">
        <div class="card card-outline <?= $card ?>">
            <div class="card-header">
                <h3 class="card-title float-left float-start mt-1"><?= ($model->isNewRecord) ? 'Добавить запись' :'Редактирование: #' . $model->id ?></h3>
                <?= Html::submitButton( 'Сохранить ', ['class' => 'btn btn-sm float-end waves-effect waves-light ' . $btn]) ?>
                <?php echo (!$model->isNewRecord) ? Html::a('Добавить новую запись', ['create'], ['class' => 'btn btn-block btn-outline-secondary btn-sm float-end me-2']) : '' ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="pb-3">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="pb-3">
                        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <?php
                        $id_contents_category = 0;
                        if (!empty(Yii::$app->request->get('id_contents_category'))) {
                            $model->id_contents_category = Yii::$app->request->get('id_contents_category');
                        }
                        ?>
                        <div class="pb-3">
                        <?= $form->field($model, 'id_contents_category')->dropDownList(ContentsCategory::getDropDownList(), ['prompt' => 'Выберите категорию..', 'class' => 'form-control form-select'])->label() ?>
                        </div>
                        <div class="pb-3">
                        <?= $form->field($model, 'key')->textInput() ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 pb-3">
                        <?= $form->field($model, 'keywords')->textarea(['rows' => 5]) ?>
                    </div>
                    <div class="col-lg-6 col-md-12 pb-3">
                        <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 pb-3">
                        <?= $form->field($model, 'text')->widget(Summernote::class, [
                            'options' => ['placeholder' => 'Укажите ваш текст тут...']
                        ]);?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="pb-3">
                        <?= $form->field($model, 'byOrder')->textInput(['placeholder' => 'Пример: 7', 'title' => 'Чем больше значение, тем ближе к началу выдачи']) ?>
                        </div>

                        <div class="pb-3">
                        <?= $form->field($model, 'published')->widget(DatePicker::class, [
                            'options' => [
                                'placeholder' => 'Пример: ' . date("d.m.Y"),
                                'value' => date("d.m.Y", $model->published > 0 ? $model->published : time()),
                            ],
                            'pluginOptions' => [
                                'format' => 'dd.mm.yyyy',
                                'todayHighlight' => true,
                            ]
                        ]); ?>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <?= $form->field($model, 'annotation')->textarea(['rows' => 4]) ?>
                    </div>
                    <div class="col-md-6 pt-3 pb-3">
                        <?php if ($model->isNewRecord): ?>
                            <?= $form->field($model, 'isPublic')->checkbox(['checked' => true]) ?>
                        <?php else: ?>
                            <?= $form->field($model, 'isPublic')->checkbox() ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-start waves-effect waves-light ' . $btn]) ?>
                <?php echo (!$model->isNewRecord) ? Html::a('Добавить новую запись', ['create'], ['class' => 'btn btn-block btn-outline-secondary btn-sm float-start ms-2']) : '' ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
if ($model->isNewRecord) {
$this->registerJsFile('@web/web/js/jquery.synctranslit.min.js', ['depends' => 'yii\web\YiiAsset', 'position' => $this::POS_END]);
$script = <<< JS
$('#contents-title').syncTranslit({
    destination: 'contents-url',
    caseStyle: 'lower'
});
JS;
$this->registerJs($script, $this::POS_READY);
}
?>
