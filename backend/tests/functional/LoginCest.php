<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    protected function formParams($email, $password)
    {
        return [
            'LoginForm[email]' => $email,
            'LoginForm[password]' => $password,
        ];
    }
    public function tryLogin(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Email', 'artdecora123@gmail.com');
        $I->fillField('Palavra passe', '123456aA');
        $I->click('login-button');

        $I->See('Administrador');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
    public function checkEmpty(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', $this->formParams('', ''));

        $I->See('É obrigatório preencher o email!');
        $I->See('É obrigatório preencher a palavra-passe!');


    }
}
