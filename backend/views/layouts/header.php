<?php

use yii\helpers\Html;
/* @var $countNotificationsHtml \common\models\Notifications */
?>

<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <?= Html::a('<i class="bi bi-envelope me-1"></i><span class="ps-1 pe-2">Уведомления</span>' . $countNotificationsHtml, ['notifications/index'], ['class' => 'nav-link']) ?>
            </li>

            <li class="nav-item d-none d-md-block dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" data-toggle="dropdown">
                    <i class="nav-icon bi bi-journal-text"></i> Страницы
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                    <?= Html::a('<i class="bi bi-house me-1"></i> Главная', ['site/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-journal-text me-1"></i> Страницы', ['contents/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-bookmarks me-1"></i> Категории', ['contents-category/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-images me-1"></i> Галерея', ['gallery-images//index'], ['class' => 'dropdown-item']) ?>
                    <div class="dropdown-divider"></div>
                    <?= Html::a('<i class="bi bi-plus me-1"></i> Добавить страницу', ['contents/create'], ['class' => 'dropdown-item text-muted']) ?>
                    <?= Html::a('<i class="bi bi-plus me-1"></i> Добавить категорию', ['contents-category/create'], ['class' => 'dropdown-item text-muted']) ?>
                </div>
            </li>
            <li class="nav-item d-none d-md-block dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-gear me-1"></i> Настройки
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                    <?= Html::a('<i class="bi bi-gear me-1"></i> Настройки', ['config/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-people me-1"></i> Пользователи', ['user/index'], ['class' => 'dropdown-item']) ?>
                    <div class="dropdown-divider"></div>
                    <?= Html::a('<i class="bi bi-plus me-1"></i> Добавить пользователя', ['user/create'], ['class' => 'dropdown-item text-muted']) ?>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
                        aria-expanded="false"
                        data-bs-toggle="dropdown"
                        data-bs-display="static">
                    <span class="theme-icon-active"><i class="my-1"></i></span>
                    <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text" style="--bs-dropdown-min-width: 8rem;">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="false">
                            <i class="bi bi-sun-fill me-2"></i> Light <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                            <i class="bi bi-moon-fill me-2"></i> Dark <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> <span class="d-none d-md-inline ps-1"><?= Yii::$app->user->identity->username ?? '' ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <p><?= Yii::$app->user->identity->name ?? '' ?><small><?= Yii::$app->user->identity->job_title ?? '' ?></small></p>
                    </li>
                    <li class="user-footer">
                        <?= Html::a('Профиль', ['/user/update', 'id' => Yii::$app->user->identity->id ?? null], ['class' => 'btn btn-default btn-flat']) ?>
                        <?= Html::a('Выход', ['/site/logout'], ['class' => 'btn btn-default btn-flat float-end', 'data' => ['method' => 'POST', 'confirm' => 'Вы точно хотите выйти?']]) ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<?php /***
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Главная', ['/hotelier/'], ['class' => 'nav-link']) ?>
        </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <li class="nav-item">
            <a class="nav-link" href="/backend/config/" role="button">
                <i class="fas fa-globe"></i>
            </a>
        </li>
        <li class="nav-item">
            <span class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </span>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['class' => 'nav-link', 'data-method' => 'post']) ?>
        </li>
    </ul>
</nav>
 ***/ ?>
