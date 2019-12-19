<?php

namespace frontend\controllers;
use frontend\models\Project;
class ProjectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDetalhes($id)
    {
        $projeto = Project::find()
            ->where(['idProject' => $id])
            ->limit(1)
            ->one();
        if($projeto)
        {
            return $this->render('detalhes', [
                'projeto' => $projeto,
            ]);
        }
        else
            return $this->redirect(['site/index']); 
    }
}
