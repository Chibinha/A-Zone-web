<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $description
 * @property int|null $parent_id
 *
 * @property Category[] $categories
 * @property Category $parent
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['parent_id'], 'integer'],
            [['description'], 'string', 'max' => 200],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id_category' => 'id']);
    }

    public function getParentName()
    {
        if($this->parent_id != null)
        {
            return Category::find()->where(['id' => $this->parent_id])->One()->description;
        }
    }

    public static function getCategories(){
        //Gets only categories and not subcategories
        $cats = Category::find()->where(['parent_id' => null])->all();

        $menu_item = [];
        foreach ($cats as $uma_cat) {
            $menu_item[] = [
                'label' => $uma_cat->description,
                'url' => ['category/view?id=' . $uma_cat->id ]
            ];
        }
        return $menu_item;
    }

    public static function getProductsByCategories($subcats, $id)
    {
        $ids = [];
        foreach($subcats as $value)
        {
            $ids[] = $value['id'];
        }

        $ids = implode(',',$ids);

        if ($ids != null)
        {
            //Se for uma categoria
            return Product::find()->where('id_category IN ('.$ids.','.$id.')')->orderBy(['unit_price' => SORT_ASC])->asArray()->all();
        }
        else
        {
            //Se for uma sub-categoria
            $ids = 0;
            return Product::find()->where('id_category IN ('.$ids.','.$id.')')->orderBy(['unit_price' => SORT_ASC])->asArray()->all();
        }        
    }
}