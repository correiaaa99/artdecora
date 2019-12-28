<?php

namespace frontend\controllers;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use Yii;
use frontend\models\IdeaBook;
use frontend\models\Image;
use frontend\models\Address;
use yii\web\UploadedFile;
class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['perfil', 'update'],
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
    public function actionUpdate()
    {  
        $model = $this->findModel(Yii::$app->user->identity->id);
        $oldImage = $model->photo;

        $addresses = Address::find()
        ->where(['idUser' => Yii::$app->user->identity->id])
        ->all();

        $address = new Address();
        if ($model->load(Yii::$app->request->post())) {  
            if(UploadedFile::getInstance($model, 'file'))
            {
                $imagem = UploadedFile::getInstance($model, 'file');
                $basePath = str_replace(DIRECTORY_SEPARATOR.'protected', "", str_replace('frontend', '', Yii::$app->basePath));
                $uploadDir = 'backend/web/images/';
                $folder = 'backend/web/';
                if($model->photo != '')
                {
                    unlink($basePath . $folder . $model->photo);
                }
                $model->photo = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' ,$imagem->baseName)) . '.' . $imagem->extension;
                if($model->save(false))
                {
                    $imagem->saveAs($basePath .$uploadDir.preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $imagem->baseName)) . '.' . $imagem->extension);
                }
                Yii::$app->session->setFlash('useralterado', 'useralterado');
                return $this->redirect(['user/perfil']);
            }
            else
            {
                $model->photo = $oldImage;
            }
            $model->save(false);
            Yii::$app->session->setFlash('useralterado', 'useralterado');
            return $this->redirect(['user/perfil']);
        } 
        else 
        {
            return $this->render('update', [
                'model' => $model,
                'addresses' => $addresses,
                'endereco' => $address,
            ]);
        }
    }
    public function actionPerfil()
    {
        $user = User::find()
        ->where(['idUser' => Yii::$app->user->identity->id])
        ->limit(1)
        ->one();

        $books = IdeaBook::find()
        ->select(['tbl_ideabook.date','tbl_ideabook.idBook','tbl_ideabook.title','tbl_project_idea_book.idProject AS projeto', 'tbl_ideabook.description', 'tbl_image.name AS imagem'])
        ->from(['tbl_ideabook'])
        ->leftJoin('tbl_project_idea_book', 'tbl_project_idea_book.idBook = tbl_ideabook.idBook')
        ->leftJoin('tbl_image', 'tbl_image.idProject = tbl_project_idea_book.idProject')
        ->where(['tbl_ideabook.idUser' => Yii::$app->user->identity->id])
        ->groupBy(['tbl_ideabook.idBook'])
        ->asArray()
        ->all();

        $livro = new IdeaBook();
        if($user)
        {
            return $this->render('perfil', [
                'user' => $user,
                'books' => $books,
                'livro' => $livro,
            ]);
        }
        else
            return $this->redirect(['site/index']); 
    }
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }     
}
