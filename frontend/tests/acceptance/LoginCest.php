<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class LoginCest
{
    public function checkLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Email', 'fernando_fcporto@hotmail.com');
        $I->fillField('Palavra passe', '123456');
        $I->click('Entrar');
        $I->wait(2);
        $I->see('Esqueceu-se da palavra-passe? Recuperar aqui!');
    }
}
