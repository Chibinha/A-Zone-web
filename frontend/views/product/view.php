<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model common\models\Product */


$this->title = $model->product_name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<?= Html::img('@web/images/' . $model->product_image, ['class' => 'product-image col-md-2 col-lg-5']); ?>
<div class="product-info">
    <h2 style="color:black;"> <?=$this->title?></h2>
    <div class="product-price-quantity">
        <h2 class="product-price"><?= Html::encode($model->unit_price) ?>€</h2>
        <div class="product-quantity">
            <p>Quantidade:</p>
            <input id="quantity" name="quantity" type="number" class="quantity-input" value="1" min="1" max="5" required> 
        </div>
        <div class="product-buttons">
            <?= Html::a('Comprar Agora', ['cart/buy', 'id' => $model->id], ['id' => 'btn-danger', 'class' => 'btn btn-danger', 'type' => 'submit', 'value' => 'Submit']) ?>
            <?= Html::a('Adicione ao Carrinho', ['cart/addcart', 'id' => $model->id, 'quantity' => 1], ['id' => 'btn-success', 'class' => 'btn btn-success', 'type' => 'submit']) ?>
        </div>
    </div>
</div>
<div class="product-description">
<h4 style="padding:-5px">Descrição</h4>
<hr style="height:1px;border:none;color: rgb(0, 175, 0);;background-color:rgb(0, 175, 0);">
    <p><?= Html::encode($model->description) ?></p>
</div>