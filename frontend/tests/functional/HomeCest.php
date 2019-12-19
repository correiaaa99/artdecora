<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(['site/index']);
        $I->seeLink('Contatos');
        $I->click('Contatos');
        $I->see('Se você tiver dúvidas comerciais ou outras questões, preencha o formulário para entrar em contato. Obrigado.');
    }
}