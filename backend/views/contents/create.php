<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contents */
/* @var $category common\models\ContentsCategory */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Контент', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
    'category' => $category,
    'mainImage' => '',
    'gallery' => '',
]) ?>
