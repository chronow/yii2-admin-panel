<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Управление';

$moduleShop = \Yii::$app->getModule('shop');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Система управления контентом</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                Добро пожаловать <strong><?= Yii::$app->user->identity->username ?? '' ?></strong> !
            </div>
        </div>
    </div>
</div>

<?php /**
<?php if (isset($moduleShop)): ?>
<div class="clearfix"></div>
<h3 class="mb-4 mt-4">Подключенные модули</h3>
<div class="clearfix"></div>
<?php endif; ?>

<div class="row">
<?php if (!empty($moduleShop->id)): ?>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">

            <div class="inner">
                <a href="<?= Url::to(['/shop']) ?>">
                <h3>Магазин</h3>
                <p>Модуль</p>
                </a>
            </div>
            <a href="<?= Url::to(['/shop']) ?>">
            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
            </svg>
            </a>
            <?= Html::a('Перейти в модуль »', ['/shop'], ['class' => 'small-box-footer']) ?>
        </div>
    </div>
<?php endif; ?>
</div>
**/ ?>