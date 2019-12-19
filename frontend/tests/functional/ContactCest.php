<?php
namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['site/contact']);
    }


    public function checkContactSubmitNoData(FunctionalTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->seeValidationError('É obrigatório preencher o nome!');
        $I->seeValidationError('É obrigatório preencher o email!');
        $I->seeValidationError('É obrigatório preencher o assunto!');
        $I->seeValidationError('É obrigatório preencher a descrição!');
        $I->seeValidationError('O código de verificação está incorreto!');
    }
}
