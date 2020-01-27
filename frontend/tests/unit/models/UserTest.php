<?php
    
    namespace frontend\tests\unit;
    use frontend\models\User;
    class UserTest extends \Codeception\Test\Unit
    {
        public function testValidation()
        {
            $user = new User();

            $user->name = null;
            $this->assertFalse($user->validate(['username']));

            $user->name = 'exemploexemploexemploexemploexemploexemploexemploexemploexemploexemplo
            exemploexemploexemploexemploexemploexemploexemploexemploexemploexemploexemploexemplo
            exemploexemploexemplo';
            $this->assertFalse($user->validate(['username']));   
        }
    }
?>