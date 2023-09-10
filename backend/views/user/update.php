<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>

<div class="user-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
