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
                <?= Html::a('<i class="bi bi-house me-1"></i> Главная', ['site/index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item d-none d-md-block">
                <?= Html::a('<i class="bi bi-envelope me-1"></i> Уведомления ' . $countNotificationsHtml, ['notifications/index'], ['class' => 'nav-link']) ?>
            </li>
            <li class="nav-item d-none d-md-block dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-gear me-1"></i> Настройки <i class="bi bi-caret-down-fill fs-8"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                    <?= Html::a('<i class="bi bi-gear me-1"></i> Настройки', ['config/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-people me-1"></i> Пользователи', ['user/index'], ['class' => 'dropdown-item']) ?>
                    <div class="dropdown-divider"></div>
                    <?= Html::a('<i class="bi bi-plus me-1"></i> Добавить пользователя', ['user/create'], ['class' => 'dropdown-item text-muted']) ?>
                </div>
            </li>
            <li class="nav-item d-none d-md-block dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="nav-icon bi bi-journal-text"></i> Страницы <i class="bi bi-caret-down-fill fs-8"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                    <?= Html::a('<i class="bi bi-journal-text me-1"></i> Страницы', ['contents/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-bookmarks me-1"></i> Категории', ['contents-category/index'], ['class' => 'dropdown-item']) ?>
                    <?= Html::a('<i class="bi bi-images me-1"></i> Галерея', ['gallery-images//index'], ['class' => 'dropdown-item']) ?>
                    <div class="dropdown-divider"></div>
                    <?= Html::a('<i class="bi bi-plus me-1"></i> Добавить страницу', ['contents/create'], ['class' => 'dropdown-item text-muted']) ?>
                    <?= Html::a('<i class="bi bi-plus me-1"></i> Добавить категорию', ['contents-category/create'], ['class' => 'dropdown-item text-muted']) ?>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <?php /***
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="/backend/web/adminlte/dist/assets/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-end fs-7 text-danger"><i class="bi bi-star-fill"></i></span>
                                </h3>
                                <p class="fs-7">Call me whenever you can...</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="/backend/web/adminlte/dist/assets/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-end fs-7 text-secondary">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                </h3>
                                <p class="fs-7">I got your message bro</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="/backend/web/adminlte/dist/assets/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 rounded-circle me-3">
                            </div>
                            <div class="flex-grow-1">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-end fs-7 text-warning">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                </h3>
                                <p class="fs-7">The subject goes here</p>
                                <p class="fs-7 text-secondary">
                                    <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                </p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            ***/ ?>

            <?php /***
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-envelope me-2"></i> 4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-people-fill me-2"></i> 8 friend requests
                        <span class="float-end text-secondary fs-7">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                        <span class="float-end text-secondary fs-7">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">
                        See All Notifications
                    </a>
                </div>
            </li>
            ***/ ?>

            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> <span class="d-none d-md-inline ps-1"><?= Yii::$app->user->identity->username ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <p><?= Yii::$app->user->identity->name ?><small><?= Yii::$app->user->identity->job_title ?></small></p>
                    </li>
                    <li class="user-footer">
                        <?= Html::a('Профиль', ['/users/update', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-default btn-flat']) ?>
                        <?= Html::a('Выход', ['/site/logout'], ['class' => 'btn btn-default btn-flat float-end', 'data-method' => 'post']) ?>
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
