<?php

use yii\helpers\Html;
?>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="/backend/" class="brand-link">
            <i class="bi bi-gear me-1 text-warning"></i>
            <span class="brand-text fw-light">Управление</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-house"></i><p>Главная</p>', ['/'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'site') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-people"></i><p>Пользователи</p>', ['/user'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'user') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-bookmarks"></i><p>Категории</p>', ['contents-category/index'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'contents-category') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-journal-text"></i><p>Страницы</p>', ['contents/index'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'contents') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-images"></i><p>Галерея</p>', ['gallery-images/index'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'gallery-images') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-envelope"></i><p>Уведомления ' . ($countNotificationsHtml ?? '') . '</p>', ['notifications/index'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'notifications') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon bi bi-gear"></i> <p>Настройки</p>', ['config/index'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'config') ? 'active' : '')]) ?>
                </li>

<!--                <li class="nav-item">-->
<!--                    <a href="#" class="nav-link">-->
<!--                        <i class="nav-icon bi bi-speedometer"></i>-->
<!--                        <p>Настройки <i class="nav-arrow bi bi-chevron-right"></i></p>-->
<!--                    </a>-->
<!--                    <ul class="nav nav-treeview">-->
<!--                        <li class="nav-item">-->
<!--                            --><?//= Html::a('<i class="nav-icon bi bi-gear"></i> <p>Общие настройки</p>', ['config/index'], ['class' => 'nav-link']) ?>
<!--                        </li>-->
<!--                        <li class="nav-item">-->
<!--                            --><?//= Html::a('<i class="nav-icon bi bi-people"></i> <p>Пользователи</p>', ['user/index'], ['class' => 'nav-link']) ?>
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>
        </nav>
    </div>
</aside>

<?php /***
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= Yii::getAlias('@web')?>/images/blogo2.png" alt="AdminLTE Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?? '' ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon fa fa-home"></i><p>Объекты</p>', ['/hotelier/objects'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'objects') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon fa fa-key"></i><p>Номера</p>', ['/hotelier/object-rooms'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'object-rooms') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon fa fa-ruble-sign"></i><p>Тарифы</p>', ['/hotelier/tarif'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'tarif') ? 'active' : '')]) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="nav-icon fa fa-images"></i><p>Галерея объектов</p>', ['/hotelier/object-gallery'], ['class' => 'nav-link ' . ((Yii::$app->controller->id == 'object-gallery') ? 'active' : '')]) ?>
                </li>
            </ul>
        </nav>
    </div>
</aside>
 ***/ ?>
