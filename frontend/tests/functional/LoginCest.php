<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;
use common\fixtures\UserFixture;

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
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }


    protected function formParams($email, $password)
    {
        return [
            'LoginForm[email]' => $email,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', $this->formParams('', ''));

        $I->See('É obrigatório preencher o email!');
        $I->See('É obrigatório preencher a palavra-passe!');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->submitForm('#login-form', $this->formParams('fernando_fcporto@hotmail.com', '718923763'));
        $I->seeValidationError('Email ou palavra-passe incorretos!');
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('Email', 'fernando_fcporto@hotmail.com');
        $I->fillField('Palavra passe', '123456aA');
        $I->click('login-button');

        $I->dontSeeLink('Registar');
    }
}
