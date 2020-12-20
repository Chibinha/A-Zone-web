<?php

use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = "A+ Zone";
?>
<?php if (Yii::$app->session->hasFlash('message')) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo yii::$app->session->getFlash('message'); ?>
    </div>
<?php endif; ?>

<h1 style="color:grey;">  <li style="color: rgb(0, 175, 0); float: left;"></li> Products</h1>
<hr style="height:2px;border:none;color: rgb(0, 175, 0);;background-color:rgb(0, 175, 0);">
<?php foreach ($products as $product) { ?>
<div class="card col-sm-1 col-md-3">
    <div class="prod-content">
        <a href="<?= Url::to(['product/view', 'id' => $product['id']]);?>">
            <?= Html::img('@web/images/' . $product['product_image'], ['class' => 'prod-img']); ?>
            <div class="prod-body">
                <h5 class="prod-title"><?= $product['product_name'] ?></h5>
                <p class="prod-text description"><?= $product['description'] ?></p>
                <div class="price-button-line">
                    <p class="prod-text price"><?= $product['unit_price'] ?>€</p>
                    <button class="btn btn-light"> Add to cart</button>
                </div>
            </div>
        </a>
    </div>
</div>
<?php } ?>
