<?php

namespace frontend\controllers;

class IdeaBookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
