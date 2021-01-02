<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$quantity = 1;
?>
<?= Html::img('@web/images/' . $model->product_image, ['class' => 'product-image col-md-2 col-lg-5']); ?>
<div class="product-info">
    <h2 style="color:black;"> <?=$this->title?></h2>
    <div>
        <h2 class="product-price"><?= Html::encode($model->unit_price) ?>€</h2>
        <div class="product-quantity">
            <p>Quantity:</p>
            <button class="btn-minus" type="text">- </button>
            <p class="text-quantity" ><?=$quantity?></p>
            <button class="btn-plus" type="text">+</button>
        </div>
        <?= Html::a('Buy Now', ['site/cart', 'id' => $model->id], ['id' => 'btn-danger', 'class' => 'btn btn-danger']) ?>
        <?= Html::a('Add to cart', ['cart/addcart', 'id' => $model->id], ['id' => 'btn-success', 'class' => 'btn btn-success']) ?>
    </div>
</div>
    
<div class="product-description">
<h4 style="padding:-5px">Descrição</h4>
<hr style="height:1px;border:none;color: rgb(0, 175, 0);;background-color:rgb(0, 175, 0);">
    <p><?= Html::encode($model->description) ?></p>
</div>


