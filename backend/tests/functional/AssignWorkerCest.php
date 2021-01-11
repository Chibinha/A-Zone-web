<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use Codeception\Util\Locator;

/**
 * Class FinishSaleCest
 */
class AssignWorkerCest
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
        $I->click('Users');

        $I->seeCurrentUrlEquals('/index-test.php/user/index');
        $I->see('Trabalhador 4');
        $I->see('trabalhador4@mailinator.com');
        $I->click('View', Locator::elementAt('//table/tbody/tr', 5));

        $I->seeCurrentUrlEquals('/index-test.php/user/view?id=5');
        $I->see('User: Trabalhador 4', 'h1');
        $I->see('This user is an employee', 'h3');
        $I->dontsee('Por Ativar');
        $I->dontsee('trabalhador@mailinator.com');
        $I->see('Ativa');
        $I->see('trabalhador4@mailinator.com');
        $I->click('Update');

        $I->seeCurrentUrlEquals('/index-test.php/user/update?id=5');
        $I->click('Revoke Worker role');

        $I->seeCurrentUrlEquals('/index-test.php/user/view?id=5');
        $I->click('Update');
        
        $I->seeCurrentUrlEquals('/index-test.php/user/update?id=5');
        $I->see('Update User: Trabalhador 4', 'h1');
        $I->seeInField('Email','trabalhador4@mailinator.com');
        $I->fillField('Email', 'trabalhador@mailinator.com');
        $I->seeInField('Email','trabalhador@mailinator.com');
        $I->seeOptionIsSelected(['name' => 'User[status]'], 'Ativa');
        $I->selectOption(['name' => 'User[status]'], 'Por Ativar');
        $I->click('Save');

        $I->seeCurrentUrlEquals('/index-test.php/user/view?id=5');
        $I->see('User: Trabalhador 4', 'h1');
        $I->dontsee('This user is an employee', 'h3');
        $I->see('Por Ativar');
        $I->see('trabalhador@mailinator.com');
        $I->dontsee('trabalhador4@mailinator.com');
    }
}
