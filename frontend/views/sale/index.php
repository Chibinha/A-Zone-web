<?php

use yii\helpers\Html;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Encomendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th style="width:15%">Data</th>
                <th style="width:15%">Total</th>
                <th style="width:15%">Estado</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <?php 
        if (sizeof($user_sales) == 0)
        {?>
            <td><h5><b>Não tem vendas por expedir</td>
        <?php }
        else
        {
            foreach($user_sales as $sale)
            { 
                $cliente = User::find()->where(['id' => $sale->id_user])->one(); ?>

                <tbody>
                    <td data-th="Data"><?= $sale->sale_date ?></td>
                    <td data-th="Total"><?= $sale->total ?></td>
                    <td data-th="Estado"><?= $sale->State ?></td> 
                    <td class="ver">
                        <?= Html::a('Ver',  ['sale/view', 'id' => $sale->id],  ['class' => 'btn btn-primary']) ?>
                    </td>  
                </tbody>
            <?php } 
        }?>
    </table>
</div>
