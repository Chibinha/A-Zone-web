<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = 'Sale: #' . $sale->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="sale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Update', ['update', 'id' => $sale->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($sale->sale_finished == '0')
        {?>
            <?=Html::a('Delete', ['delete', 'id' => $sale->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);} ?>
    </p>
    <br>

    <h3>Informação do comprador</h3>
    <table class="table">
        <thead>
            <tr>
                <th style="width:15%">Cliente</th>
                <th style="width:10%">Telefone</th>
                <th style="width:30%">Endereço</th>
                <th style="width:15%">Codigo Postal</th>
                <th style="width:10%">Cidade</th>
                <th style="width:10%">País</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
                <td data-th="Cliente"><?= $buyer->firstName ." ". $buyer->lastName?></td>
                <td data-th="Telefone"><?= $buyer->phone ?></td>
                <td data-th="Endereço"><?= $buyer->address ?></td>
                <td data-th="Codigo Postal"><?= $buyer->postal_code ?></td> 
                <td data-th="Cidade"><?= $buyer->city ?></td> 
                <td data-th="País"><?= $buyer->country ?></td> 
            </tr> 
        </tbody>
    </table>
    <br>

    <h3>Informação da Venda</h3>
    <table class="table">
        <thead>
            <tr>
                <th style="width:25%">Data</th>
                <th style="width:25%">Total</th>
                <th style="width:25%"></th>
            </tr>
        </thead>
        <tbody>
                <td data-th="Data"><?= $sale->sale_date?></td>
                <td data-th="Total"><?= $sale->total ?></td>
                <?php if ($sale->sale_finished == '1')
                {?>
                    <td style="color:red" data-th="Estado"><b><?= $sale->state ?></b></td>
                <?php } else { ?>
               <td style="color:blue" data-th="Estado"><?= $sale->state ?></td>
                <?php } ?>

            </tr> 
        </tbody>
    </table>
    <br>

    <h3>Produtos</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'Produto',
                'value' => 'product.product_name'
            ],
            [
                'attribute' => 'Preço por Unidade',
                'value' => 'unit_price'
            ],
            [
                'attribute' => 'Quantidade',
                'value' => 'quantity'
            ],
        ]
    ]); ?>
</div>
