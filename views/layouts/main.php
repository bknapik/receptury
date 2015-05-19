<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
        'brandLabel' => 'Receptury',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!\Yii::$app->user->getIsSuperAdmin()) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Składniki', 'url' => ['/skladniki/index']],
                ['label' => 'Receptury', 'url' => ['/receptury/index']],
                ['label' => 'Produkty', 'url' => ['/produkty/index']],
                ['label' => 'Odbiorcy', 'url' => ['/odbiorcy/index']],
                ['label' => 'Inne', 'items' => [
                    ['label' => 'Funkcje technologiczne', 'url' => ['/funkcje/index']],
                    ['label' => 'Stawki VAT', 'url' => ['/stawki/index']],
                    ['label' => 'Alergeny', 'url' => ['/alergeny/index']],
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
                ['label' => 'Składniki', 'url' => ['/skladniki/index']],
                ['label' => 'Receptury', 'url' => ['/receptury/index']],
                ['label' => 'Produkty', 'url' => ['/produkty/index']],
                ['label' => 'Odbiorcy', 'url' => ['/odbiorcy/index']],
                ['label' => 'Inne', 'items' => [
                    ['label' => 'Funkcje technologiczne', 'url' => ['/funkcje/index']],
                    ['label' => 'Stawki VAT', 'url' => ['/stawki/index']],
                    ['label' => 'Alergeny', 'url' => ['/alergeny/index']],
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
        <p class="pull-left">&copy; Receptury <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
