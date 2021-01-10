<?php

namespace common\tests\unit;

use Codeception\Test\Unit;
use common\models\SaleItem;
use common\models\Sale;
use common\models\Product;
use common\fixtures\SaleItemFixture;
use common\fixtures\SaleFixture;
use common\fixtures\ProductFixture;

class SaleItemTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'saleItem' => [
                'class' => SaleItemFixture::className(),
                'dataFile' => codecept_data_dir() . 'saleItem_data.php'
            ],
            'sale' => [
                'class' => SaleFixture::className(),
                'dataFile' => codecept_data_dir() . 'sale_data.php'
            ],
            'product' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product_data.php'
            ],
        ];
    }

    public function testSaleItemPriceNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->unit_price = "Not Number";
        $this->assertFalse($saleItem->validate(['unit_price']));
    }

    public function testSaleItemPriceNull(){        
        $saleItem = new SaleItem();
        $saleItem->unit_price = null;
        $this->assertFalse($saleItem->validate(['unit_price']));
    }

    public function testSaleItemPriceCorrect(){        
        $saleItem = new SaleItem();
        $saleItem->unit_price = 59.99;
        $this->assertTrue($saleItem->validate(['unit_price']));
    }

    public function testSaleItemIdProductNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->id_product = "Not Number";
        $this->assertFalse($saleItem->validate(['id_product']));
    }

    public function testSaleItemIdProductNull(){        
        $saleItem = new SaleItem();
        $saleItem->id_product = null;
        $this->assertFalse($saleItem->validate(['id_product']));
    }

    public function testSaleItemIdSaleNotNumber(){        
        $saleItem = new SaleItem();
        $saleItem->id_sale = "Not Number";
        $this->assertFalse($saleItem->validate(['id_sale']));
    }

    public function testSaleItemIdSaleNull(){        
        $saleItem = new SaleItem();
        $saleItem->id_sale = null;
        $this->assertFalse($saleItem->validate(['id_sale']));
    }

    function testCreateSaleItem()
    {
        $this->tester->dontseeRecord('common\models\SaleItem', ['unit_price' => '20.00']);
        $this->tester->dontseeRecord('common\models\SaleItem', ['quantity' => 4]); 

        $sale = Sale::find(1)->One();
        $prod = Product::find(1)->One();

        $saleItem = new SaleItem();
        $saleItem->id = 2;
        $saleItem->unit_price = "20.00";
        $saleItem->quantity = 4;
        $saleItem->id_product = 1;
        $saleItem->id_sale = 1;
        $saleItem->save();
        
        $this->tester->seeRecord('common\models\SaleItem', ['unit_price' => '20.00']);
        $this->tester->seeRecord('common\models\SaleItem', ['quantity' => 4]); 
    }

    function testUpdateSaleItem()
    {
        $this->tester->seeRecord('common\models\SaleItem', ['unit_price' => '10.00']);
        $this->tester->seeRecord('common\models\SaleItem', ['quantity' => '2']);
        $this->tester->seeRecord('common\models\SaleItem', ['id_product' => '1']);
        
        $saleItem = SaleItem::find()->where(['id_product' => '1'])->andWhere(['id_sale' => '1'])->One();

        $saleItem->unit_price = "99.10";
        $saleItem->quantity = "4";
        $saleItem->save();
        
        $this->tester->seeRecord('common\models\SaleItem', ['unit_price' => '99.10']);
        $this->tester->seeRecord('common\models\SaleItem', ['quantity' => '4']);;
        $this->tester->dontseeRecord('common\models\SaleItem', ['unit_price' => '10.00']);
        $this->tester->dontseeRecord('common\models\SaleItem', ['quantity' => '2']);
    }

    function testDeleteSaleItem()
    {
        $this->tester->seeRecord('common\models\SaleItem', ['unit_price' => '10.00']);
        $this->tester->seeRecord('common\models\SaleItem', ['quantity' => '2']);
        $this->tester->seeRecord('common\models\SaleItem', ['id_product' => '1']);
        
        $saleItem = SaleItem::find()->where(['id_product' => '1'])->andWhere(['id_sale' => '1'])->One();
        $saleItem->delete();
        
        $this->tester->dontseeRecord('common\models\SaleItem', ['unit_price' => '10.00']);
        $this->tester->dontseeRecord('common\models\SaleItem', ['quantity' => '2']);
    }
}
