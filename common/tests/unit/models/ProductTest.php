<?php

namespace frontend\tests\unit\models;

use common\fixtures\CategoryFixture;
use common\fixtures\ProductFixture;
use common\models\Category;
use common\models\Product;

class ProductTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php'
            ],
            'product' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product_data.php'
            ],
        ];
    }

    public function testProductNameTooLong(){        
        $products = new Product();
        $products->product_name = "tooooooooooooooooooooooooloooooooooooooooooooooooong";
        $this->assertFalse($products->validate(['product_name']));
    }

    public function testProductNameNull(){        
        $products = new Product();
        $products->product_name = null;
        $this->assertFalse($products->validate(['product_name']));
    }

    public function testProductNameCorrect(){        
        $products = new Product();
        $products->product_name = "Asus vivobook";
        $this->assertTrue($products->validate(['product_name']));
    }

    public function testProductDescriptionNull(){        
        $products = new Product();
        $products->description = null;
        $this->assertFalse($products->validate(['description']));
    }

    public function testProductDescriptionCorrect(){        
        $products = new Product();
        $products->description = "O computador portátil Asus VivoBook apresenta equilíbrio perfeito entre desempenho e beleza.";
        $this->assertTrue($products->validate(['description']));
    }

    public function testProductPriceNull(){        
        $products = new Product();
        $products->unit_price = null;
        $this->assertFalse($products->validate(['unit_price']));
    }

    public function testProductPriceCorrect(){        
        $products = new Product();
        $products->unit_price = "129.99";
        expect($products->hasErrors())->false();
        $this->assertTrue($products->validate(['unit_price']));
    }

    function testCreatingProduct()
    {
        $this->tester->dontseeRecord('common\models\Product', ['description' => 'prod description']);
        $this->tester->dontseeRecord('common\models\Product', ['product_image' => 'image2.jpg']);

        $prod = new Product();
        $prod->product_name = "prod name";
        $prod->unit_price = "10.00";
        $prod->description = "prod description";
        $prod->product_image = "image2.jpg";
        $prod->id_category = 1;

        $prod->save();
        $this->tester->seeRecord('common\models\Product', ['description' => 'prod description']);
        $this->tester->seeRecord('common\models\Product', ['product_image' => 'image2.jpg']);
    }

    function testUpdatingProduct()
    {
        $this->tester->seeRecord('common\models\Product', ['description' => 'Test description']);
        $this->tester->seeRecord('common\models\Product', ['unit_price' => '20.00']);
        $this->tester->dontseeRecord('common\models\Product', ['description' => 'prod description']);
        $this->tester->dontseeRecord('common\models\Product', ['unit_price' => '10.00']);
        $prod = Product::find()->where(['description' => 'Test description'])->One();

        $prod->product_name = "prod name";
        $prod->unit_price = "10.00";
        $prod->description = "prod description";
        $prod->id_category = 1;

        $prod->save();
        $this->tester->seeRecord('common\models\Product', ['description' => 'prod description']);
        $this->tester->seeRecord('common\models\Product', ['unit_price' => '10.00']);
    }

    function testDeletingProduct()
    {
        $this->tester->seeRecord('common\models\Product', ['description' => 'Test description']);
        $this->tester->seeRecord('common\models\Product', ['unit_price' => '20.00']);
        $prod = Product::find()->where(['description' => 'Test description'])->One();
        $prod->delete();

        $this->tester->dontseeRecord('common\models\Product', ['description' => 'Test description']);
        $this->tester->dontseeRecord('common\models\Product', ['unit_price' => '20.00']);
    }
}
