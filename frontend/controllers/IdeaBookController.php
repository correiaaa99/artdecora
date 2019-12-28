<?php

namespace frontend\controllers;
use frontend\models\IdeaBook;
use Yii;
class IdeaBookController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'delete', 'update'],
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
        $book = new IdeaBook();
        if($book->load(Yii::$app->request->post()))
        {
            $book->date = date('Y-m-d');
            $book->idUser = Yii::$app->user->identity->id;
            if($book->save())
            {
                Yii::$app->session->setFlash('livroInserido', 'livroInserido');
                return $this->redirect(['user/perfil']);
            }
        }
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        $projetos = $model->projetos;
        if($projetos != null)
        {
            foreach($projetos as $projeto)
            {
                $projeto->delete();
            }
        }
        return "eliminado";

    }
    public function actionUpdate($id)
    {
        $bookUpdate = $this->findModel($id);
        if(Yii::$app->request->isAjax)  {
            $data = Yii::$app->request->post();
            $title = $data['title'];
            $description = $data['description'];;
            $bookUpdate->title = $title;
            $bookUpdate->description = $description;
           if($bookUpdate->save())
           {
               return "alterado";
           }
        }
    }
    protected function findModel($id) {
        if (($model = IdeaBook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
}
