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
            <div class="col-md-4 col-lg-3 text-black">
                <div class="row h-100 vh-100 justify-content-center align-items-center" style="background:url(/backend/img/background/<?= rand(1, 10)?>.jpg); background-color:#3b3b3b; background-size: cover;">

                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['style' => 'width: 23rem; margin: 0 auto']]); ?>
                    <h3 class="fw-normal pb-2" style="letter-spacing: 1px;"><img src="/backend/web/img/yii3.svg" width="55px" alt=""> <?= $this->title ?></h3>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'username', [
                            'template' => "{input}{label}{error}\n{hint}",
                            'options' => [
                                'tag'=>false,
                            ],
                        ])->textInput(['autofocus' => true, 'class' => 'form-control rounded-3', 'placeholder' => $model->getAttributeLabel('username')]) ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'name', [
                            'template' => "{input}{label}{error}\n{hint}",
                            'options' => [
                                'tag'=>false,
                            ],
                        ])->textInput(['autofocus' => true, 'class' => 'form-control rounded-3', 'placeholder' => $model->getAttributeLabel('name')]) ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'email', [
                            'template' => "{input}{label}{error}\n{hint}",
                            'options' => [
                                'tag'=>false,
                            ],
                        ])->textInput(['autofocus' => true, 'class' => 'form-control rounded-3', 'placeholder' => $model->getAttributeLabel('email')]) ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'phone', [
                            'template' => "{input}{label}{error}\n{hint}",
                            'options' => [
                                'tag'=>false,
                            ],
                        ])->textInput(['maxlength' => true])->widget(MaskedInput::class, [
                            'mask' => '+7 (999) 999-99-99', 'options' => ['placeholder' => '+X (XXX) XXX-XX-XX', 'class' => 'form-control rounded-3']
                        ]) ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?= $form->field($model, 'password', [
                            'template' => "{input}{label}{error}\n{hint}",
                            'options' => [
                                'tag'=>false,
                            ],
                        ])->passwordInput(['class' => 'form-control rounded-3', 'placeholder' => $model->getAttributeLabel('email')]) ?>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <?= \yii\helpers\Html::a(Yii::t('app', 'Авторизация'), ['login'], ['class' => 'w-100 btn btn-outline-secondary rounded-3',]) ?>
                        </div>
                        <div class="col-6">
                            <?= \yii\helpers\Html::submitButton('Регистрация', ['class' => 'w-100 btn btn-danger rounded-3']) ?>
                        </div>
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