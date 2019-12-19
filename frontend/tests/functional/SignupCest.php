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
        $I->see('Mínimo = 6 carateres | 1 dígito | 1 caráter maiúsculo e 1 minúsculo');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('É obrigatório preencher o username!');
        $I->seeValidationError('É obrigatório preencher o email!');
        $I->seeValidationError('É obrigatório preencher a palavra-passe!');
        $I->seeValidationError('É obrigatório preencher o confirmar palavra-passe!');

    }
    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'fernandocorreia12',
            'SignupForm[email]' => 'fernando_fcporto@hotmail.com',
            'SignupForm[password]' => '123456aA',
            'SignupForm[confirmarpassword]' => '123456aA',
        ]);
    }
}
