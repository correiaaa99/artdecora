<?php

namespace frontend\controllers;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use Yii;
class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['perfil'],
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
            if($user)
            {
                return $this->render('/site/perfil', [
                    'user' => $user,
                ]);
            }
            else
                return $this->render('/site/index');
        }
        else
            return $this->render('site/index');
    }
}
