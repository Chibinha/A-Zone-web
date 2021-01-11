<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Codeception\Util\Locator;

/**
 * Class FinishSaleCest
 */
class FinishSaleCest
{
    /**
     * @param FunctionalTester $I
     */
    public function FinishSale(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('Vendas por expedir', 'h1');
        $I->see('Logout (Bruno)');
        $I->see('2021-01-09 17:35:44');
        $I->see('Ver', Locator::elementAt('//table/tbody', 2));
        $I->click('Ver', Locator::elementAt('//table/tbody', 2));

        $I->seeCurrentUrlEquals('/index-test.php/sale/view?id=3');
        $I->see('Cliente Um');
        $I->see('966966966');
        $I->see('2021-01-09 17:35:44');
        $I->click('Update');

        $I->seeCurrentUrlEquals('/index-test.php/sale/update?id=3');
        $I->see('Update Sale: #3', 'h1');
        $I->see('Berbequim Aparafusador PECOL POWER TOOLS APRO-0');
        $I->see('Remover Item', Locator::elementAt('//table/tr', 2));
        $I->click('Remover Item', Locator::elementAt('//table/tr', 2));
        $I->dontsee('Berbequim Aparafusador PECOL POWER TOOLS APRO-0');
        $I->checkOption('#sale-sale_finished');
        $I->click('Save');

        $I->seeCurrentUrlEquals('/index-test.php/sale/view?id=3');
        $I->click('Home');

        $I->seeCurrentUrlEquals('/index-test.php/site/index');
        $I->see('Vendas por expedir', 'h1');
        $I->dontsee('2021-01-09 17:35:44');
    }
}
