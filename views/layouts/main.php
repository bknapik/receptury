<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Konfiguracja;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'RecePik',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!\Yii::$app->user->getIsSuperAdmin()) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => \app\models\Konfiguracja::trans('skladniki'), 'url' => ['/skladniki/index']],
                ['label' => \app\models\Konfiguracja::trans('receptury'), 'url' => ['/receptury/index']],
                ['label' => \app\models\Konfiguracja::trans('produkty'), 'url' => ['/produkty/index']],
                ['label' => \app\models\Konfiguracja::trans('odbiorcy'), 'url' => ['/odbiorcy/index']],
                ['label' => 'Inne', 'items' => [
                    ['label' => \app\models\Konfiguracja::trans('funkcje'), 'url' => ['/funkcje/index']],
                    ['label' => \app\models\Konfiguracja::trans('stawki'), 'url' => ['/stawki/index']],
                    ['label' => \app\models\Konfiguracja::trans('alergeny_'), 'url' => ['/alergeny/index']],
                ]],
                ['label' => \Yii::$app->user->getIdentity()->getName(), 'items' => [
                    ['label' => 'Profil', 'url' => ['/auth/profile/view']],
                    ['label' => 'Wyloguj', 'url' => ['/auth/default/logout']],
                ]],

            ],
        ]);
    } else {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => \app\models\Konfiguracja::trans('skladniki'), 'url' => ['/skladniki/index']],
                ['label' => \app\models\Konfiguracja::trans('receptury'), 'url' => ['/receptury/index']],
                ['label' => \app\models\Konfiguracja::trans('produkty'), 'url' => ['/produkty/index']],
                ['label' => \app\models\Konfiguracja::trans('odbiorcy'), 'url' => ['/odbiorcy/index']],
                ['label' => 'Inne', 'items' => [
                    ['label' => \app\models\Konfiguracja::trans('funkcje'), 'url' => ['/funkcje/index']],
                    ['label' => \app\models\Konfiguracja::trans('stawki'), 'url' => ['/stawki/index']],
                    ['label' => \app\models\Konfiguracja::trans('alergeny_'), 'url' => ['/alergeny/index']],
                ]],
                ['label' => \Yii::$app->user->getIdentity()->getName(), 'items' => [
                    ['label' => 'Profil', 'url' => ['/auth/profile/view']],
                    ['label' => 'Użytkownicy', 'url' => ['/auth/user/index']],
                    ['label' => 'Wyloguj', 'url' => ['/auth/default/logout']],
                ]],

            ],
        ]);
    }
    NavBar::end();
    ?>

    <div class="container">
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; RecePik <?= (date('Y') != 2015) ? '2015 - ' : '' ?><?= date('Y') ?></p>
    </div>
</footer>
<script>
    var defaultNumberOfItems = <?= Konfiguracja::trans('liczba_wpisow') ?>
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
