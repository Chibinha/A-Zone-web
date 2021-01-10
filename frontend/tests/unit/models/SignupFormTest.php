<?php

namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\models\SignupForm;
use common\models\User;

class SignupFormTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_data.php'
            ],
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
            'firstName' => 'some_firstName', 
            'lastName' => 'some_lastName', 
            'phone' => '000000000', 
            'address' => 'Some address', 
            'postal_code' => '1234-123', 
            'city' => 'Some City', 
            'country' => 'Some Country', 
            'nif' => '123456789',
        ]);

        $user = $model->signup();
        expect($user)->true();

        /** @var \common\models\User $user */
        $user = $this->tester->grabRecord('common\models\User', [
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'status' => \common\models\User::STATUS_ACTIVE,
        ]);

        $profile = $this->tester->grabRecord('common\models\Profile', [
            'firstName' => 'some_firstName',
            'city' => 'Some City',
            'nif' => '1234-123'
        ]);
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'bayer.hudson',
            'email' => 'nicole.paucek@schultz.info',
            'password' => 'some_password',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('username'))
            ->equals('Este username já foi registado.');
        expect($model->getFirstError('email'))
            ->equals('Este e-mail já foi registado.');
    }
}
