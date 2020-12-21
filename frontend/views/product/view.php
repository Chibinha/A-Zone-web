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
        <?= Html::a('Buy Now', ['cart/addcart', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Add to cart', ['cart/addcart', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>
</div>
    
<div class="product-description">
<h4>Descrição</h4>
    <p><?= Html::encode($model->description) ?></p>
</div>


