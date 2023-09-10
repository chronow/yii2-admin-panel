<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contents */
/* @var $isMain backend\models\GalleryImages */
/* @var $mainImage backend\models\GalleryImages */
/* @var $gallery backend\models\GalleryImages */
/* @var $category common\models\ContentsCategory */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Контент', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<?= $this->render('_form', [
    'model' => $model,
    'mainImage' => $mainImage,
    'gallery' => $gallery,
    'category' => $category,
]) ?>
