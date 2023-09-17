<?php

use yii\helpers\Html;
use common\models\Config;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $config common\models\Config */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
$tab = Yii::$app->request->get('tabsType') ?? 0;
$group = '';
?>
<div class="card card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <?php foreach (Config::$type as $key => $value): ?>
                <li class="nav-item">
                    <a href="#key-<?= $key ?>" 
                    id="key-<?= $key ?>-tab"
                    data-bs-toggle="tab"
                    data-toggle="pill"
                    role="tab"
                    aria-controls="#key-<?= $key ?>"
                    aria-expanded="<?= $key == $tab ? 'true' : 'false' ?>"
                    aria-selected="<?= $key == $tab ? 'true' : 'false' ?>"
                    class="nav-link <?= $key == $tab ? 'active' : '' ?>"><?= $value ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="card-body">
        <?php if (!empty(Config::$type)): ?>
            <div class="tab-content pt-0">
                <?php foreach (Config::$type as $key => $value): ?>
                    <div class="tab-pane fade <?= $key == $tab ? 'show active' : '' ?>" id="key-<?= $key ?>" role="tabpanel">
                        <?php if (!empty($config[$key])): ?>
                        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
                        <table class="table table-sm mb-0">
                            <?php foreach ($config[$key] as $k => $model): ?>
                                <?php if ($group != $model->group && $model->group != ''): ?>
                                <tr>
                                    <td class="text-end" style="border-top: none; padding-top: 25px"></td>
                                    <td class="text-end" style="border-top: none; padding-top: 25px">
                                        <h4><?= $model->group ?> <i class="fe-edit"></i></h4>
                                    </td>
                                </tr>
                                <?$group = $model->group?>
                                <?php endif; ?>
                                <tr>
                                    <td class="pt-2"><span class="text-secondary font12"><?= $model->key ?></span></td>
                                    <td>
                                        <?php if ($model->type == 'boolean'): ?>
                                            <?= $form->field($model, 'value[' . $k . ']', [
                                                'options' => ['tag' => false],
                                                'template' => "
                                                    <div class='row font-14'>
                                                        <div class='col-4 col-xl-3'><div class='col-form-label fw-bold'>{label}</div></div>
                                                        <div class='col-8 col-xl-9 mt-1'><div class='form-check'>{input}\n{hint}\n{error}</div></div>
                                                    </div>
                                                "
                                            ])->checkbox(['value' => 1, 'checked'=> $model->value ? true : false, 'label' => 'да', 'class' => 'form-check-input'])->label($model->name, ['class' => 'form-check-label']) ?>
                                        <?php elseif ($model->type == 'text'): ?>
                                            <?= $form->field($model, 'value[' . $k . ']', [
                                                'options' => ['tag' => false],
                                                'template' => "<div class='row font-14'>{label}<div class='col-8 col-xl-9'>{input}\n{hint}\n{error}</div></div>"
                                            ])->textInput(['class' => 'form-control'])->label($model->name, ['class' => 'col-4 col-xl-3 col-form-label fw-bold'])->textarea(['value' => $model->value]) ?>
                                        <?php elseif ($model->type == 'file'): ?>
                                            <?php
                                                $hint = null;
                                                if (!empty($model->value)) {
                                                    $hint = '<a href="' . $model->value . '" target="_blank" style="text-decoration: none"><small class="text-muted ps-1">Файл загружен: </small><small>' . $model->value . '</small></a>';
                                                }
                                            ?>
                                            <?= $form->field($model, 'file[' . $k . ']', [
                                                'options' => ['tag' => false],
                                                'template' => "<div class='row font-14'>{label}<div class='col-8 col-xl-9'>{input}\n{hint}\n{error}</div></div>"
                                            ])->fileInput(['class' => 'form-control', 'title' => $model->value])->label($model->name, ['class' => 'col-4 col-xl-3 col-form-label fw-bold'])->hint($hint) ?>
                                        <?php else: ?>
                                            <?= $form->field($model, 'value[' . $k . ']', [
                                                'options' => ['tag' => false],
                                                'template' => "<div class='row font-14'>{label}<div class='col-8 col-xl-9'>{input}\n{hint}\n{error}</div></div>"
                                            ])->textInput(['class' => 'form-control'])->label($model->name, ['class' => 'col-4 col-xl-3 col-form-label fw-bold'])->input(null, ['value' => $model->value]) ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                            <td style="border-bottom: none; padding:15px 0px"></td>
                                <td style="border-bottom: none; padding:15px 0px">
                                    <div class='row font-14'>
                                        <div class="col-4 col-xl-3"></div>
                                        <div class='col-8 col-xl-9'>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-sm float-start waves-effect waves-light btn-primary']) ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php ActiveForm::end(); ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
