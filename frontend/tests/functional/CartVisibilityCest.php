<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\fixtures\ProfileFixture;

class CartVisibilityCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_data.php',
            ],
        ];
        return [
            'profile' => [
                'class' => ProfileFixture::className(),
                'dataFile' => codecept_data_dir() . 'profile_data.php',
            ],
        ];
    }

    public function seeCartWithoutLogin(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Carrinho');
        $I->SeeLink('Carrinho');
        $I->See('Login');
        $I->click('Carrinho');

        $I->seeCurrentUrlEquals('/index-test.php/site/cart');
        $I->See('Checkout','h1');
        $I->See('Inicie sessão para aceder ao seu carrinho.','h3');
        $I->click('Iniciar Sessão');

        $I->seeCurrentUrlEquals('/index-test.php/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'bayer.hudson',
            'LoginForm[password]' => 'password_0',
        ], 'login-button');

        $I->seeCurrentUrlEquals('/index-test.php');
        $I->see('A minha conta');
        $I->dontSeeLink('Login');
        $I->see('Carrinho');
        $I->click('Carrinho');

        $I->seeCurrentUrlEquals('/index-test.php/site/cart');
        $I->See('Checkout','h1');
        $I->dontSee('Inicie sessão para aceder ao seu carrinho.','h3');
    }
}
