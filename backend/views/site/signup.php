<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\SignupForm */

use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
$this->title = Yii::t('app', 'Регистрация');
?>

<section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">
                <div class="row h-100 vh-100 justify-content-center align-items-center" style="background:url(/backend/img/bg-pattern.png); background-color:#faebd7; background-size: cover;">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['style' => 'width: 23rem; margin: 0 auto']]); ?>
                    <h3 class="fw-normal pb-2" style="letter-spacing: 1px;"><img src="/backend/web/img/yii3.svg" width="55px" alt=""> <?= $this->title ?></h3>

                    <div class="form-outline mb-3">
                        <?= $form->field($model, 'username', [
                            'template' => "{label}{error}\n{input}\n{hint}"
                        ])->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg']) ?>
                    </div>

                    <div class="form-outline mb-3">
                        <?= $form->field($model, 'name', [
                            'template' => "{label}{error}\n{input}\n{hint}"
                        ])->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg']) ?>
                    </div>

                    <div class="form-outline mb-3">
                        <?= $form->field($model, 'email', [
                            'template' => "{label}{error}\n{input}\n{hint}"
                        ])->textInput(['autofocus' => true, 'class' => 'form-control form-control-lg']) ?>
                    </div>

                    <div class="form-outline mb-3">
                        <?= $form->field($model, 'phone', [
                            'template' => "{label}{error}\n{input}\n{hint}"
                        ])->textInput(['maxlength' => true])->widget(MaskedInput::class, [
                            'mask' => '+7 (999) 999-99-99', 'options' => ['placeholder' => '+X (XXX) XXX-XX-XX', 'class' => 'form-control form-control-lg']
                        ]) ?>
                    </div>

                    <div class="form-outline mb-3">
                        <?= $form->field($model, 'password', [
                            'template' => "{label}{error}\n{input}\n{hint}"
                        ])->passwordInput(['class' => 'form-control form-control-lg']) ?>
                    </div>

                    <div class="pt-1 mb-3">
                        <?= \yii\helpers\Html::submitButton($this->title, ['class' => 'btn btn-danger']) ?>
                        <?= \yii\helpers\Html::a(Yii::t('app', 'Войти'), ['login'], ['class' => 'ml-1 float-end text-danger',]) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
                     alt="Login image" class="w-100 vh-100 bg-image-vertical" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section>
