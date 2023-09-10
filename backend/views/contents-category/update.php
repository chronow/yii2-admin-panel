<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContentsCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контент', 'url' => ['contents/']];
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
