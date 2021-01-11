<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use common\fixtures\UserFixture;
use common\fixtures\ProfileFixture;

use yii\helpers\Url;

class PlaceOrderCest
{
    public function _fixtures()
    {
    }

    public function placeOrder(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->See('Login');
        $I->click('Login');

        $I->seeCurrentUrlEquals('/site/login');
        $I->wait(1);
        $I->fillField('#loginform-username', 'Bruno');
        $I->fillField('#loginform-password', '00000000');
        $I->click('#btn-submit');
        $I->wait(1);

        $I->seeCurrentUrlEquals('/');
        $I->see('A minha conta');
        $I->dontSeeLink('Login');
        $I->wait(1);
        $I->see('Banco de Escritório VIDAXL branco');
        $I->click('Banco de Escritório VIDAXL branco');

        $I->seeCurrentUrlEquals('/product/view?id=18');
        $I->wait(1);
        $I->see('Descrição');
        $I->see('Adicione ao Carrinho');
        $I->click('Adicione ao Carrinho');

        $I->seeCurrentUrlEquals('/site/index');
        $I->wait(1);
        $I->see('Produto adicionado ao seu Carrinho');
        $I->see('Secretária DS MUEBLES iCub');
        $I->wait(1);
        $I->click('Secretária DS MUEBLES iCub');
        
        $I->seeCurrentUrlEquals('/product/view?id=24');
        $I->wait(1);
        $I->see('Descrição');
        $I->see('Comprar Agora');
        $I->click('Comprar Agora');

        $I->seeCurrentUrlEquals('/site/cart');
        $I->wait(1);
        $I->see('Checkout');
        $I->see('Banco de Escritório VIDAXL branco');
        $I->see('Secretária DS MUEBLES iCub');
        $I->see('Terminar compra');
        $I->click('Terminar compra');
        $I->acceptPopup();

        $I->seeCurrentUrlEquals('/site/finish-sale');
        $I->wait(1);
        $I->see('A sua compra foi concluida com sucesso!');
        $I->click('#btn-voltar');

        $I->seeCurrentUrlEquals('/site/index');
    }
}
