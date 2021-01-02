<?php

use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\Html;
use yii\web\Session;
/* @var $this yii\web\View */

$this->title = "A+ Zone";
?>
<?php if (Yii::$app->session->hasFlash('message')) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo yii::$app->session->getFlash('message'); ?>
    </div>
<?php endif; ?>

<h1 style="color:grey;"> <span style="color: rgb(0, 175, 0); float: left;">| </span>Products</h1>
<?php if (!empty($message)) { ?>
    <h4 style="color:grey;"> <?=$message?></h4>
<?php } ?>
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
                    <?= Html::a('Add to cart', ['cart/addcart', 'id' => $product['id']], ['class' => 'btn btn-light']) ?>
                </div>
            </div>
        </a>
    </div>
</div>
<?php } ?>
