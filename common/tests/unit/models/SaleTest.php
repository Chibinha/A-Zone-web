<?php

namespace common\tests\unit;

use common\models\Sale;
use common\fixtures\SaleFixture;
use common\fixtures\UserFixture;

class SaleTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'sale' => [
                'class' => SaleFixture::className(),
                'dataFile' => codecept_data_dir() . 'sale_data.php'
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_data.php'
            ],
        ];
    }

    public function testSaleDateNull(){        
        $sale = new Sale();
        $sale->sale_date = null;
        $this->assertFalse($sale->validate(['sale_date']));
    }

    public function testSaleDateCorrect(){        
        $sale = new Sale();
        $sale->sale_date = "2020-01-10 16:54:54";
        $this->assertTrue($sale->validate(['sale_date']));
    }

    public function testSaleStateNull(){        
        $sale = new Sale();
        $sale->sale_finished = 3;
        $this->assertFalse($sale->validate(['sale_finished']));
    }

    public function testSaleStateCorrect(){        
        $sale = new Sale();
        $sale->sale_finished = 1;
        $sale2 = new Sale();
        $sale2->sale_finished = 0;
        $this->assertTrue($sale->validate(['sale_finished']));
        $this->assertTrue($sale2->validate(['sale_finished']));
    }

    public function testSaleState(){  
        $sale = new Sale(); 
        $sale->sale_finished = 1;

        $state = $sale->State;
        $this->assertEquals('Encomenda expedida', $state);

        $sale->sale_finished = 0;

        $state = $sale->State;
        $this->assertEquals('A preparar encomenda', $state);
    }

    function testCreateSale()
    {
        $this->tester->dontseeRecord('common\models\Sale', ['sale_date' => '2021-11-11']);
        $this->tester->dontseeRecord('common\models\Sale', ['sale_finished' => 1]); 

        $sale = new Sale();
        $sale->sale_date = "2021-11-11";
        $sale->sale_finished = 1;
        $sale->id_user = 1;
        $sale->save();
        
        $this->tester->seeRecord('common\models\Sale', ['sale_date' => '2021-11-11']);
        $this->tester->seeRecord('common\models\Sale', ['sale_finished' => 1]); 
    }

    function testUpdateSale()
    {
        $this->tester->seeRecord('common\models\Sale', ['sale_date' => '2020-10-10']);
        $this->tester->seeRecord('common\models\Sale', ['sale_finished' => '0']); 
        
        $sale = Sale::find()->where(['sale_date' => '2020-10-10'])->One();

        $sale->sale_date = "2021-11-11";
        $sale->sale_finished = "1";
        $sale->save();
        
        $this->tester->dontseeRecord('common\models\Sale', ['sale_date' => '2020-10-10']);
        $this->tester->dontseeRecord('common\models\Sale', ['sale_finished' => '0']); 
        $this->tester->seeRecord('common\models\Sale', ['sale_date' => '2021-11-11']);
        $this->tester->seeRecord('common\models\Sale', ['sale_finished' => '1']); 
    }

    function testDeleteSale()
    {
        $this->tester->seeRecord('common\models\Sale', ['sale_date' => '2020-10-10']);
        $this->tester->seeRecord('common\models\Sale', ['sale_finished' => '0']); 

        $sale = Sale::find()->where(['sale_date' => '2020-10-10'])->One();
        $sale->delete();
        
        $this->tester->dontseeRecord('common\models\Sale', ['sale_date' => '2020-10-10']);
        $this->tester->dontseeRecord('common\models\Sale', ['sale_finished' => '0']); 
    }
}
