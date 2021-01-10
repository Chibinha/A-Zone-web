<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $sale_date
 * @property bool $sale_finished
 * @property int $id_user
 *
 * @property User $user
 * @property SaleItem[] $saleItems
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_date'], 'safe'],
            [['sale_finished'], 'boolean'],
            [['id_user', 'sale_date'], 'required'],
            [['id_user'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_date' => 'Data',
            'sale_finished' => 'Encomenda expedida',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleItems()
    {
        return $this->hasMany(SaleItem::className(), ['id_sale' => 'id']);
    }

    public function getState(){
        if ($this->sale_finished == "1"){
            return "Encomenda expedida";
        }
        else{
            return "A preparar encomenda";
        }
    }

    public static function getQuantityPrice($sale_item)
    {
        $subTotal = $sale_item['unit_price'] * $sale_item['quantity'];
        return $subTotal;
    }

    public function getTotal()
    {
        $sale_items = SaleItem::find()->where(['id_sale' => $this->id])->all();
        $total = 0;

        foreach ($sale_items as $item)
        {
            $total += $item->unit_price * $item->quantity;
        }
        return $total . '€';
    }

    public function beforeDelete()
    {
        foreach (SaleItem::findAll(['id_sale' => $this->id]) as $item) {
           $item->deleteInternal();
        }
        return parent::beforeDelete();
    }
}
