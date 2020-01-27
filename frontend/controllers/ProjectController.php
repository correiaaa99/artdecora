<?php

namespace frontend\controllers;
use frontend\models\Project;
use frontend\models\Request;
use frontend\models\Evalution;
use Yii;
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
        if(!Yii::$app->user->isGuest)
        {
            $evalutionSearch = Evalution::find()
            ->where(['idUser' =>  Yii::$app->user->identity->id])
            ->andWhere(['idProject' => $id])
            ->one();
            if($evalutionSearch)
            {
                $avaliacao = $evalutionSearch->evalution;
            }
            else
            {
                $avaliacao = 0;
            }
        }
        else
        {
            $avaliacao = 0;
        }

        $request = new Request();
        $evalution = new Evalution();
        if($projeto)
        {
            return $this->render('detalhes', [
                'projeto' => $projeto,
                'request' => $request,
                'evalution' => $evalution,
                'evalutionSearch'  => $avaliacao,
            ]);
        }
        else
            return $this->redirect(['site/index']); 
    }
}
