<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale_item".
 *
 * @property int $id
 * @property float $unit_price
 * @property int $quantity
 * @property int $id_product
 * @property int $id_sale
 */
class SaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_price', 'quantity', 'id_product', 'id_sale'], 'required'],
            [['unit_price'], 'number'],
            [['quantity', 'id_product', 'id_sale'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'id_product' => 'Id Product',
            'id_sale' => 'Id Sale',
        ];
    }
}
