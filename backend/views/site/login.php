<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Вход');
?>

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-3 text-black">
                <div class="row h-100 vh-100 justify-content-center align-items-center" style="background:url(/backend/img/background/<?= rand(1, 10)?>.jpg); background-color:#3b3b3b; background-size: cover;">


                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['style' => 'width: 23rem; margin: 0 auto']]); ?>
                        <h3 class="fw-normal pb-2" style="letter-spacing: 1px;"><img src="/backend/web/img/yii3.svg" width="55px" alt=""> Авторизация</h3>

                        <div class="form-floating mb-3">
                            <?= $form->field($model, 'username', [
                                'template' => "{input}{label}{error}\n{hint}",
                                'options' => [
                                    'tag'=>false,
                                ],
                            ])->textInput(['autofocus' => true, 'class' => 'form-control rounded-3', 'placeholder' => 'Логин']) ?>
                        </div>

                        <div class="form-floating mb-3">
                            <?= $form->field($model, 'password', [
                                'template' => "{input}{label}{error}\n{hint}",
                                'options' => [
                                    'tag'=>false,
                                ],
                            ])->passwordInput(['class' => 'form-control rounded-3', 'placeholder' => 'Пароль']) ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                            <?= \yii\helpers\Html::submitButton('Авторизация', ['class' => 'w-100 btn btn-danger rounded-3']) ?>
                            </div>
                            <?php //= Html::a(Yii::t('app', 'Забыли пароль?'), ['request-password-reset'], ['class' => 'ml-1',]) ?>
                            <div class="col-6">
                            <?= \yii\helpers\Html::a(Yii::t('app', 'Регистрация'), ['signup'], ['class' => 'w-100 btn btn-outline-secondary rounded-3',]) ?>
                            </div>
                        </div>

                        <div class="form-outline">
                        <?= \common\widgets\Alert::widget() ?>
                        </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <div class="col-md-8 col-lg-9 px-0 d-none d-sm-block" style="background-color: #212529;">
                <div class="d-flex flex-wrap vh-100 align-items-center">
                    <img width="512" height="512" src="/backend/img/background/sq2.png" class="mx-auto text-center" style="object-fit: cover; object-position: left;" >
                </div>
            </div>
        </div>
    </div>
</section>
