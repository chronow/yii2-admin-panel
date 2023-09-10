<?php
use yii\helpers\Html;
use backend\models\GalleryImages;

/* @var $model \backend\models\GalleryImages */

$title = Html::encode($model->title);

$img = (!empty($model->resize3)) ? $model->resize3 : '@web/web/img/no.png' ;
$img = Html::img($img, ['style' => 'max-width:100%', 'loading' => 'lazy', 'class' => 'img-fluid']);
?>

<div class="col-md-4 col-xl-3">
    <div class="card product-box">
        <div class="card-body p-2">
            <div class="float-end position-relative text-center w-100">
                <div class="product-action">
                    <?= Html::a('<i class="bi bi-pencil"></i>', ['update', 'id' => $model->id], ['title' => 'Редактировать', 'target' => '_blank', 'class' => 'btn btn-success btn-sm waves-effect waves-light']); ?>
                    <?= Html::a('<i class="bi bi-x-lg"></i>', ['delete', 'id' => $model->id], ['title' => 'Удалить', 'class' => 'btn btn-danger btn-sm waves-effect waves-light', 'data-method' => 'post', 'onclick' => "return window.confirm('Вы точно хотите Удалить?');"]); ?>
                </div>
                <?= Html::a($img, ['update', 'id' => $model->id], ['title' => $title, 'class' => 'card-img', 'loading' => 'lazy']); ?>
            </div>
            <div class="product-info">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="fs-6 mt-3 text-truncate"><?= $title ?></h5>
                    </div>
                    <div class="col-auto">
                        <small class="text-muted"><i class="bi bi-arrows-angle-expand"></i> <?= GalleryImages::getImageSize($model->original) ?></small>
                        <small class="ps-2 text-muted"><span class="bi bi-box"></span> <?= GalleryImages::getFileSize($model->original) ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
