<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\GalleryImages;

/* @var $this yii\web\View */
/* @var $model backend\models\GalleryImages */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['gallery-images/index']];
$this->params['breadcrumbs'][] = 'Изображение #' . $model->id;

$boolOriginal = GalleryImages::getFileEx($model['original'] ?? null);
$boolResize1 = GalleryImages::getFileEx($model['resize1'] ?? null);
$boolResize2 = GalleryImages::getFileEx($model['resize2'] ?? null);
$boolResize3 = GalleryImages::getFileEx($model['resize3'] ?? null);

$card = ($model->isNewRecord) ? 'card-primary' : 'card-warning';
$btn = ($model->isNewRecord) ? 'btn-primary' : 'btn-warning';
?>

<?php $form = ActiveForm::begin(); ?>

<div class="gallery-images-update">
    <div class="row">
        <div class="col-md-7">
            <?php if ($boolOriginal): ?>
                <div class="card card-warning">
                    <div class="card-header with-border">
                        <h3 class="card-title float-left float-start mt-1">
                            Оригинал
                            <small class="ps-4 text-secondary"><i class="bi bi-arrows-angle-expand"></i> <?= GalleryImages::getImageSize($model['original']) ?></small>
                            <small class="ps-4 text-secondary"><span class="bi bi-box"></span> <?= GalleryImages::getFileSize($model['original']) ?></small>
                        </h3>
                        <?= Html::a('<span class="bi bi-repeat me-2"></span> Обжим', ['resize', 'id' => $model->id, 'type' => 'original'], ['class' => 'btn btn-sm btn-warning pr-2 float-end']) ?>
                    </div>
                    <div class="card-body text-center">
                        <?= Html::img($model['original'], ['alt' => 'original', 'id' => 'original', 'loading' => 'lazy', 'style' => ['max-width' => '100%']]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-5">
            <div class="card card-outline <?= $card ?>">
                <div class="card-header">
                    <h3 class="card-title float-left float-start mt-1">Изображение: #<?= $model->id ?></h3>
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-end waves-effect waves-light ' . $btn]) ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 pb-3">
                            <?= $form->field($model, 'title')->textInput() ?>
                        </div>
                        <div class="col-md-12 pb-3">
                            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
                        </div>
                        <div class="col-md-4 pb-3">
                            <?= $form->field($model, 'order_image')->textInput() ?>
                        </div>
                        <div class="col-12 pb-3">
                            <?= $form->field($model, 'imageFiles', [
                                'options' => ['tag' => false],
                                'template' => "<div class='font-14'>{label}\n{input}\n{hint}\n{error}</div>"
                            ])->fileInput(['multiple' => false, 'accept' => 'image/*', 'data-plugins' => 'dropify', 'class' => 'form-control dropify form-control-file']); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm waves-effect waves-light w-100 ' . $btn]) ?>
                        </div>

                        <div class="col-md-4">
                            <?php /**
                            <?php if ($boolOriginal): ?>
                            <?= Html::a('<span class="fa fa-retweet"></span> Автообрезка',
                            ['crop', 'id' => $model->id],
                            ['class' => 'btn btn-sm btn-default w-100']) ?>
                            <?php endif; ?>
                             **/ ?>
                        </div>

                        <div class="col-md-4">
                            <?= Html::a('<span class="fa fa-trash"></span> Удалить', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-default w-100',
                                'data' => [
                                    'confirm' => 'Вы точно хотите удалить?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if ($boolResize1): ?>
            <div class="col-md-5">
                <div class="card card-default mt-4">
                    <div class="card-header with-border">
                        <h3 class="card-title pt-2">
                            Размер 1
                            <small class="ps-4 text-secondary"><i class="bi bi-arrows-angle-expand"></i> <?= GalleryImages::getImageSize($model['resize1']) ?></small>
                            <small class="ps-4 text-secondary"><span class="bi bi-box"></span> <?= GalleryImages::getFileSize($model['resize1']) ?></small>
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <?= Html::img($model['resize1'], ['alt' => 'resize1', 'id' => 'resize1', 'loading' => 'lazy', 'style' => ['max-width' => '100%']]) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($boolResize2): ?>
            <div class="col-md-4">
                <div class="card card-default mt-4">
                    <div class="card-header with-border">
                        <h3 class="card-title pt-2">
                            Размер 2
                            <small class="ps-4 text-secondary"><i class="bi bi-arrows-angle-expand"></i> <?= GalleryImages::getImageSize($model['resize2']) ?></small>
                            <small class="ps-4 text-secondary"><span class="bi bi-box"></span> <?= GalleryImages::getFileSize($model['resize2']) ?></small>
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <?= Html::img($model['resize2'], ['alt' => 'resize2', 'id' => 'resize2', 'loading' => 'lazy', 'style' => ['max-width' => '100%']]) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($boolResize3): ?>
            <div class="col-md-3">
                <div class="card card-default mt-4">
                    <div class="card-header with-border">
                        <h3 class="card-title pt-2">
                            Размер 3
                            <small class="ps-4 text-secondary"><i class="bi bi-arrows-angle-expand"></i> <?= GalleryImages::getImageSize($model['resize3']) ?></small>
                            <small class="ps-4 text-secondary"><span class="bi bi-box"></span> <?= GalleryImages::getFileSize($model['resize3']) ?></small>
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <?= Html::img($model['resize3'], ['alt' => 'resize3', 'id' => 'resize3', 'loading' => 'lazy', 'style' => ['max-width' => '100%']]) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="card card-default mt-4 mb-4">
        <div class="card-header with-border">
            <h3 class="card-title"><i class="bi bi-info-circle pe-2"></i> Информация по изображениям</h3>
        </div>
        <div class="card-body">
            <?= \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'original',
                        'label' => 'original',
                        'format' => 'raw',
                        'value' => !empty($model->original) ? '<code>' . $model->original . '</code>' : null
                    ],
                    [
                        'attribute' => 'resize1',
                        'label' => 'resize1',
                        'format' => 'raw',
                        'value' => !empty($model->resize1) ? '<code>' . $model->resize1 . '</code>' : null
                    ],
                    [
                        'attribute' => 'resize2',
                        'label' => 'resize2',
                        'format' => 'raw',
                        'value' => !empty($model->resize2) ? '<code>' . $model->resize2 . '</code>' : null
                    ],
                    [
                        'attribute' => 'resize3',
                        'label' => 'resize3',
                        'format' => 'raw',
                        'value' => !empty($model->resize3) ? '<code>' . $model->resize3 . '</code>' : null
                    ],
                    'title:ntext',
                ],
            ]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
