<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update', 'index', 'delete'],
                'rules' => [                
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ], 
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function getUsers()
    {
        return User::find()->count();
    }
    public function getCountUser()
    {
        $count = User::find()->count();
        return $count;
    }
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        
        if ($model->load(Yii::$app->request->post()))
        {    
            $model->generateEmailVerificationToken();
            if(UploadedFile::getInstance($model,'file'))
            {
                $model->file = UploadedFile::getInstance($model,'file');
                $imageName = $model->username;
                $model->photo = 'images/' . $imageName . '.' . $model->file->extension;
                $model->save();
                $model->file->saveAs('images/'.$imageName .'.'. $model->file->extension);
               return $this->redirect(['index']); 
               
            }
            $model->save();
            return $this->redirect(['index']); 
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);
        $session->set('id', $model->idUser);
        $oldImage = $model->photo;
        
        if ($model->load(Yii::$app->request->post())) {  
            $image = UploadedFile::getInstance($model, 'file');
            if(UploadedFile::getInstance($model, 'file'))
            {
                
                $model->photo = 'images/' . $model->username .'.'. $image->extension; 
            }
            else
            {
                $model->photo = $oldImage;
            }
            if($model->save())
            {
                if(isset($image)){
                    $image->saveAs($model->photo);   
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try 
        {
            $model = $this->findModel($id);
            $books = $model->ideaBook;
            $addresses = $model->addresses;
            if($books != null)
            {
                \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este utilizador porque está inserido num ou mais livros de ideias!');
                return $this->redirect(['index']);
            }
            else if($addresses != null)
            {
                \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este utilizador porque contém ou mais endereços!');
                return $this->redirect(['index']);
            }
            else
            {
                if($model->photo != '')
                {
                    unlink(Yii::$app->basePath . '/web/' . $model->photo);
                }
                $this->findModel($id)->delete();        
                return $this->redirect(['index']);
            }
        }
        catch(\yii\db\IntegrityException $e)
        {
            \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este utilizador!');
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }      
}
