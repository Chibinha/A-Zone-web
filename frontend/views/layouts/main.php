<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => 'A+ ZONE',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
$menuItems = [
    ['label' => '<span class="glyphicon glyphicon-home"></span> &ensp; Página Inicial', 'url' => ['/site/index']],

    ['label' => '<span class="glyphicon glyphicon-shopping-cart"></span> &ensp; Carrinho', 'url' => ['/site/cart']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Registar', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => '<span class="glyphicon glyphicon-log-in"></span> Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => '<span class="glyphicon glyphicon-briefcase"></span> &ensp; A minha conta',
        'items' => [
            [
                'label' => '<span class="glyphicon glyphicon-edit"></span> &ensp; Informações da Conta',
                'url' => ['/user/update', 'id' => Yii::$app->user->identity->id],
            ],
            [
                'label' => '<span class="glyphicon glyphicon-gift"></span> &ensp; Encomendas',
                'url' => ['/sale/index', 'id' => Yii::$app->user->identity->id],
            ],
            [
                'label' => '<span class="glyphicon glyphicon-log-out"></span> &ensp; Logout',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ],
        ],
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'encodeLabels' => false,
    'items' => $menuItems,
]);
echo '</li></ul>';
NavBar::end();
?>

<div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>