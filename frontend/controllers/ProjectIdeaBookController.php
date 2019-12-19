<?php

namespace frontend\controllers;
use Yii;
use frontend\models\ProjectIdeaBook;
class ProjectIdeaBookController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['update', 'create', 'index', 'delete'],
                'rules' => [                
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {
        $livro = new ProjectIdeaBook();
        if($livro->load(Yii::$app->request->post()))
        {
            //testar se o projeto selecionado já está associado ao livro
            $projectBook = ProjectIdeaBook::findByProjectAndBook($livro->idProject,$livro->idBook);
            if($projectBook)
            {
                Yii::$app->session->setFlash('projetoassociado', 'projetoassociado');
                return $this->redirect(['site/index']);
            }
            else
            {
                Yii::$app->session->setFlash('projetoassociadosucesso', 'projetoassociadosucesso');
                $livro->save();
                return $this->redirect(['site/index']); 
            }
        }
    }

}
