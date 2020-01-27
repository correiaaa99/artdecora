<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Evalution;
class EvalutionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {
        $evalution = new Evalution();
        
        if (Yii::$app->request->isAjax) {
            if (!Yii::$app->user->isGuest) 
            {
                $data = Yii::$app->request->post();
                $avaliacao = $data['evalution'];
                $projeto = $data['project'];
                $evalutionSearch = Evalution::find()
                ->where(['idUser' =>  Yii::$app->user->identity->id])
                ->andWhere(['idProject' => $projeto])
                ->one();
                if($evalutionSearch)
                {
                    $evalutionSearch->evalution = $avaliacao;
                    $evalutionSearch->save(false);     
                    $projetoMediaContador = Evalution::find()
                    ->select(['ROUND(AVG(evalution),2) AS avaliacao', 
                    'COUNT(id_Project_User) AS contador'])
                    ->from('tbl_project_user')
                    ->where(['idProject' => $projeto])
                    ->limit(1)
                    ->one();
                    echo json_encode(array($projetoMediaContador->avaliacao, $projetoMediaContador->contador));
                }
                else
                {
                    $evalution->idProject = $projeto;
                    $evalution->idUser = Yii::$app->user->identity->id;
                    $evalution->evalution = $avaliacao;
                    $evalution->save();
                    $projetoMediaContador = Evalution::find()
                    ->select(['ROUND(AVG(evalution),2) AS avaliacao', 
                    'COUNT(id_Project_User) AS contador'])
                    ->from('tbl_project_user')
                    ->where(['idProject' => $projeto])
                    ->limit(1)
                    ->one();
                    echo json_encode(array($projetoMediaContador->avaliacao, $projetoMediaContador->contador));
                }
            }
            else
            {
                Yii::$app->session->setFlash('avaliacao', 'avaliacao');
                return $this->redirect(['site/index']);
            }
        } 
    }
}
