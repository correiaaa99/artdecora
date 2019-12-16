<?php

namespace frontend\controllers;

class ProjectController extends \yii\web\Controller
{
    public function behaviors()
    {
        
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

}
