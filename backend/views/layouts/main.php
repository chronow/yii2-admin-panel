<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use backend\assets\LteAsset;
use common\widgets\Alert;
use common\models\Notifications;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

LteAsset::register($this);
AppAsset::register($this);

$countNotificationsHtml = null;
if ($countNotifications = Notifications::find()->where(['status' => Notifications::STATUS_NEW])->count()) {
    $countNotificationsHtml = '<span class="nav-badge badge text-bg-warning" title="Не прочитанные сообщения">' . $countNotifications . '</span>';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <base href="/" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= Yii::getAlias('@web') ?>/web/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Yii::getAlias('@web') ?>/web/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::getAlias('@web') ?>/web/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= Yii::getAlias('@web') ?>/web/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= Yii::getAlias('@web') ?>/web/img/favicon/safari-pinned-tab.svg" color="#da532c">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">

    <?php $this->head() ?>
</head>
<body class="sidebar-expand-lg bg-body-tertiary">
<?php $this->beginBody() ?>
<div class="app-wrapper">
    <?= $this->render('header.php', compact('countNotificationsHtml')) ?>
    <?= $this->render('left.php', compact('countNotificationsHtml')) ?>
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 mt-1"><?= Html::encode($this->title) ?></h3>
                    </div>
                    <div class="col-sm-6">

<?= Breadcrumbs::widget([
    'homeLink' => [
        'label' => 'Главная',
        'url' => Yii::getAlias('@web') . '/',
    ],
    'options' => [
        'class' => 'breadcrumb float-sm-end',
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">

<?= Alert::widget() ?>
<?= $content ?>

            </div>
        </div>
    </main>
    <?= $this->render('footer.php') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
