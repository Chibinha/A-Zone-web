<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $product_name
 * @property float|null $unit_price
 * @property bool $is_discontinued
 * @property string $description
 * @property string $product_image
 * @property int $id_category
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'unit_price' ,'description', 'id_category'], 'required'],
            [['unit_price'], 'number'],
            [['is_discontinued'], 'boolean'],
            [['description'], 'string'],
            [['id_category'], 'integer'],
            [['product_name'], 'string', 'max' => 50],
            [['product_image'], 'file', 'extensions' => 'jpeg,jpg,png'],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'unit_price' => 'Unit Price',
            'is_discontinued' => 'Is Discontinued?',
            'description' => 'Description',
            'product_image' => 'Product Image',
            'id_category' => 'Category',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }
}
