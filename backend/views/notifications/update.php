<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notifications */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование #' . $model->fio;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
