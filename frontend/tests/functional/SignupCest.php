<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Registar', 'h1');
        $I->see('Preencha os campos para criar conta', 'p');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Introduza um username.');
        $I->seeValidationError('Introduza o seu e-mail.');
        $I->seeValidationError('Introduza uma password.');
        $I->seeValidationError('Introduza o seu nome.');
        $I->seeValidationError('Introduza o seu apelido.');
        $I->seeValidationError('Introduza o seu NIF.');
        $I->seeValidationError('Introduza o seu número de telefone.');
        $I->seeValidationError('Introduza a sua morada.');
        $I->seeValidationError('Introduza o seu código de postal.');
        $I->seeValidationError('Introduza a sua cidade.');
        $I->seeValidationError('Introduza o seu país.');
    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
            'SignupForm[username]' => 'some_username',
            'SignupForm[email]' => 'some_emailmail.com',
            'SignupForm[password]' => 'some_password',
            'SignupForm[firstName]' => 'some_firstname',
            'SignupForm[lastName]' => 'some_lastname',
            'SignupForm[phone]' => '123456789',
            'SignupForm[address]' => 'tester',
            'SignupForm[postal_code]'=> '1234-123',
            'SignupForm[city]' => 'Some City',
            'SignupForm[country]' => 'Some Country',
            'SignupForm[nif]' => '123456789',
        ]);
        $I->dontSee('Introduza um username.');
        $I->dontSee('Introduza uma password.');
        $I->dontSee('Introduza o seu nome.');
        $I->dontSee('Introduza o seu apelido.');
        $I->dontSee('Introduza o seu NIF.');
        $I->dontSee('Introduza o seu número de telefone.');
        $I->dontSee('Introduza a sua morada.');
        $I->dontSee('Introduza o seu código de postal.');
        $I->dontSee('Introduza a sua cidade.');
        $I->dontSee('Introduza o seu país.');
        $I->seeValidationError('Introduza um e-mail válido.');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'some_username',
            'SignupForm[email]' => 'some_email@mail.com',
            'SignupForm[password]' => 'some_password',
            'SignupForm[firstName]' => 'some_firstname',
            'SignupForm[lastName]' => 'some_lastname',
            'SignupForm[phone]' => '123456789',
            'SignupForm[address]' => 'tester',
            'SignupForm[postal_code]'=> '1234-123',
            'SignupForm[city]' => 'Some City',
            'SignupForm[country]' => 'Some Country',
            'SignupForm[nif]' => '123456789',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'some_username',
            'email' => 'some_email@mail.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $profile = $I->grabRecord('common\models\Profile', [
            'firstName' => 'some_firstname',
            'city' => 'Some City',
            'nif' => '123456789'
        ]);

        $I->see(' O registo foi completado com sucesso!');
    }
}
