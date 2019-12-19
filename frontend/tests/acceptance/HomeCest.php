<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));

        $I->seeLink('Contatos');
        $I->click('Contatos');
        $I->wait(2); // wait for page to be opened
        $I->see('Se você tiver dúvidas comerciais ou outras questões, preencha o formulário para entrar em contato. Obrigado.');
    }
}
