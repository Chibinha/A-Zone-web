<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
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
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function loginAdmin(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'Bruno',
            'LoginForm[password]' => '00000000',
        ], 'login-button');

        $I->dontSee('Login');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
        $I->see('Home');
        $I->SeeLink('Home');
        $I->see('Sales');
        $I->SeeLink('Sales');
        $I->see('Products');
        $I->SeeLink('Products');
        $I->see('Categories');
        $I->SeeLink('Categories');
        $I->see('Logout (Bruno)');
    }
    
    public function loginWorker(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'Trabalhador 2',
            'LoginForm[password]' => '00000000',
        ], 'login-button');

        $I->dontSee('Login');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
        $I->see('Home');
        $I->SeeLink('Home');
        $I->see('Sales');
        $I->SeeLink('Sales');
        $I->see('Products');
        $I->SeeLink('Products');
        $I->see('Categories');
        $I->SeeLink('Categories');
        $I->dontsee('Users');
        $I->dontSeeLink('Users');
        $I->see('Logout (Trabalhador 2)');
    }

    public function loginClient(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'Cliente 1',
            'LoginForm[password]' => '00000000',
        ], 'login-button');

        $I->see('Forbidden (#403)', 'h1');
        $I->dontSee('Login');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
        $I->dontsee('Home');
        $I->dontsee('Sales');
        $I->dontsee('Products');
        $I->dontsee('Categories');
        $I->dontsee('Users');
        $I->see('Logout (Cliente 1)');
    }
}
