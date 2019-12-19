<?php

namespace frontend\controllers;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use Yii;
use frontend\models\IdeaBook;
use frontend\models\Image;
class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['site/perfil'],
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
    public function actionPerfil($id)
    {
        if($id == Yii::$app->user->identity->id)
        {
            $user = User::find()
            ->where(['idUser' => $id])
            ->limit(1)
            ->one();

            $books = IdeaBook::find()
            ->select(['tbl_ideabook.title','tbl_project_idea_book.idProject AS projeto', 'tbl_ideabook.description', 'tbl_image.name AS imagem'])
            ->from(['tbl_ideabook'])
            ->leftJoin('tbl_project_idea_book', 'tbl_project_idea_book.idBook = tbl_ideabook.idBook')
            ->leftJoin('tbl_image', 'tbl_image.idProject = tbl_project_idea_book.idProject')
            ->where(['tbl_ideabook.idUser' => $id])
            ->groupBy(['tbl_ideabook.idBook'])
            ->asArray()
            ->all();
            if($user)
            {
                return $this->render('perfil', [
                    'user' => $user,
                    'books' => $books,
                ]);
            }
            else
                return $this->redirect(['site/index']); 
        }
        else
            return $this->redirect(['site/index']); 
    }
}
