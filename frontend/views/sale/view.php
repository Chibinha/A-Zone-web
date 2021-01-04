<?php

use yii\helpers\Html;
use common\models\Product;
use common\models\Sale;

$Total = 0;
?>

<div class="sale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    </p>
    <h2><b>Encomenda</b></h2>
    <br>
    <h4><b>Morada de entrega</b></h4>
    <p><?= $buyer['firstName'], " ", $buyer['lastName'] ?></p>
    <p><?= $buyer['address']?></p>
    <p><?= $buyer['postal_code'], ", ", $buyer['city'] ?></p>
    <p><?= $buyer['country']?></p>
    <hr>
    <h4 style="font-weight: bold;">Produtos comprados:</h4>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th style="width:40%">Item</th>
                <th style="width:15%" class="text-center">Preço</th>
                <th style="width:15%" class="text-center">Quantidade</th>
                <th style="width:15%" class="text-center">Subtotal</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sale_items as $item) {
                $product_info = Product::find()->where(['id' => $item['id_product']])->one();?>
                <tr>
                    <td data-th="Item">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs">
                                <?= Html::img('@web/images/' . $product_info['product_image'], ['class' => 'img-responsive']); ?>
                            </div>
                            <div class="col-sm-9">
                                <h5><?= $product_info['product_name'] ?></h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Preço" class="text-center"><?= $item['unit_price'] ?>€</td>
                    <td data-th="Quantidade" class="text-center"><?= $item['quantity'] ?></td>
                    <td data-th="Subtotal" class="text-center"><?= Sale::getQuantityPrice($item) ?>€</td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total: <?= $sale->total ?>€</strong></td>
            </tr>
        </tfoot>
    </table>
    <br>
</div>
