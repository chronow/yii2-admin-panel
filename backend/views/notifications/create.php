<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Notifications */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = ['label' => 'Уведомления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
