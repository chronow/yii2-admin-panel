<?php

use yii\helpers\Html;
/* @var $isMain backend\models\GalleryImages */
?>

<div class="row">
    <?php if (!empty($gallery)): ?>
        <?php foreach ($gallery as $item): ?>
            <div class="col-lg-2 col-md-3 mb-2">
                <div class="position-relative">
                    <div class="badge badge-primary" title="Сортировка" style="position: absolute; left: 10px; top: 10px"><?= $item->order_image ?></div>
                    <?php if ($item->getFileEx($item->resize3)): ?>
                        <?= Html::img($item->resize3, ['style' => 'max-width:100%', 'loading' => 'lazy']) ?>
                    <?php else: ?>
                        <?= Html::img('/img/no-img.png', ['style' => 'max-width:100%', 'loading' => 'lazy']) ?>
                    <?php endif; ?>
                    <div class="clearfix mt-1"></div>
                    <div class="bottom-line">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <?= Html::a('<i class="fa fa-pencil-alt"></i>', ['/gallery-images/update', 'id' => $item->id], ['title' => 'Редактировать', 'target' => '_blank', 'class' => 'btn btn-xs btn-light waves-effect']); ?>
                            </div>
                            <div class="col-sm-6 text-right">
                                <?= Html::a('<i class="fa fa-trash"></i>', ['/gallery-images/delete', 'id' => $item->id], ['title' => 'Удалить', 'class' => 'btn btn-xs btn-light waves-effect', 'data-method' => 'post', 'onclick' => "return window.confirm('Вы точно хотите Удалить?');"]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>
