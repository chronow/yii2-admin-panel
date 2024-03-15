<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        Возможно мы работаем над этим разделом и очень скоро он здесь появится.
    </p>
    <p class="mb-0">
        Пожалуйста, свяжитесь с нами, если вы считаете, что это ошибка сервера. Спасибо.
    </p>
</div>
