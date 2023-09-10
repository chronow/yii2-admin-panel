<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создать запись';
?>

<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
