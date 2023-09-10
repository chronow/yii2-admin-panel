<?php

use yii\helpers\Html;
/* @var $isMain backend\models\GalleryImages */
?>

<div class="row">
<?php if (!empty($gallery)): ?>
<?php foreach ($gallery as $item): ?>
<div class="col-lg-6 mb-2">
    <div class="product-box">
        <div class="product-action">
            <?= Html::a('<i class="mdi mdi-pencil"></i>', ['/gallery-images/update', 'id' => $item->id], ['title' => 'Редактировать', 'target' => '_blank', 'class' => 'btn btn-success btn-sm waves-effect waves-light']); ?>
            <?= Html::a('<i class="mdi mdi-close"></i>', ['/gallery-images/delete', 'id' => $item->id], [
                    'title' => 'Удалить',
                    'class' => 'btn btn-danger btn-sm waves-effect waves-light',
                    'data' => [
                        'confirm' => 'Вы точно хотите Удалить этот элемент?',
                        'method' => 'post',
                    ],
            ]);
            ?>
        </div>
        <div class="badge badge-primary" title="Сортировка" style="position: absolute; left: 10px; top: 10px"><?= $item->order_image ?></div>
        <?php if ($item->getFileEx($item->resize3)): ?>
            <?= Html::img($item->resize3, ['style' => 'max-width:100%', 'loading' => 'lazy']) ?>
        <?php else: ?>
            <?= Html::img('/img/no.jpg', ['style' => 'max-width:100%', 'loading' => 'lazy']) ?>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
