<?php

namespace backend\Controllers;
use backend\models\User;
class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function getCountUser()
    {
        $count = User::find()->count();
        return $count;
    }

}
