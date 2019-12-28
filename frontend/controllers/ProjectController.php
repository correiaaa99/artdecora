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
        ->select(['tbl_project.price', 'tbl_project.date','tbl_project.idProject', 'tbl_project.name', 'tbl_project.description', 'ROUND(AVG(tbl_project_user.evalution),2) AS avaliacao', 
        'COUNT(tbl_project_user.id_Project_User) AS contador'])
            ->from(['tbl_project'])
            ->leftJoin('tbl_project_user', 'tbl_project_user.idProject = tbl_project.idProject')
            ->where(['tbl_project.idProject' => $id])
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
