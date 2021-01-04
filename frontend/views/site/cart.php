<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerJsFile('@web/js/script.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="sale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="site-cart">
    <h1>Checkout</h1>
    <div class="container">
        <hr>
        <?php if (Yii::$app->user->isGuest) { ?>
            <h3><b>Inicie sessão para aceder ao seu carrinho.</b></h3>
            <a class="btn btn-primary" href="login">Iniciar Sessão</a>
        <?php } else { ?>
    <h3><b>Morada de entrega</b></h3>
    <p><?= $buyer['firstName'], " ", $buyer['lastName'] ?></p>
    <p><?= $buyer['address']?></p>
    <p><?= $buyer['postal_code'], ", ", $buyer['city'] ?></p>
    <p><?= $buyer['country']?></p>
    <hr>
    <h3 style="font-weight: bold;">Carrinho</h3>
    <table class="table">
        <thead>
            <tr>
                <th style="width:40%">Item</th>
                <th style="width:15%" class="text-center">Preço</th>
                <th style="width:5%">Quantidade</th>
                <th style="width:15%" class="text-center">Subtotal</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($cart); $i++) { ?>
                <tr>
                    <td data-th="Item">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs">
                                <a href="<?= Url::to(['product/view', 'id' => $cart[$i]->id]);?>"> 
                                    <?= Html::img('@web/images/' . $cart[$i]->product_image, ['class' => 'img-responsive']); ?>
                                </a>
                            </div>
                            <div class="col-sm-9">
                                <a href="<?= Url::to(['product/view', 'id' => $cart[$i]->id]);?>"> 
                                    <h5><?= $cart[$i]->product_name ?></h5> 
                                </a>
                            </div>
                        </div>
                    </td>
                    <td data-th="Preço" class="text-center"><?= $cart[$i]->unit_price ?>€</td>
                    <td data-th="Quantidade">
                        <?php $form = ActiveForm::begin(['action' => ['cart/quantity', 'id' => $cart[$i]->id],]) ?>
                        <input onchange="this.form.submit()" name="quantity" type="number" class="quantidade form-control text-center" value="<?= $quantity[$i] ?>" min="1" max="5" oninput="validity.valid||(value='1');">
                        <?php ActiveForm::end() ?>
                    </td>
                    <td data-th="Subtotal" class="text-center"><?= $subtotal[$i] ?>€</td>
                    <td class="remove">
                        <?= Html::a('Remover Item', ['cart/removecart', 'id' => $cart[$i]->id], ['class' => 'btn btn-danger btn-sm']) ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: <span id="total"><?= $total ?></span>€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td><td class="hidden-xs text-center"><strong>Total <?= $total ?>€</strong></td>
                <td>
                    <?=Html::a('Terminar compra', ['sale/create',], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Deseja fazer uma encomenda?',
                        'method' => 'post',
                    ],
                    ]);?>
                </td>
            </tr>
        </tfoot>
    </table>
    <br>
</div>
<?php } ?>