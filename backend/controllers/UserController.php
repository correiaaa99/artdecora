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
use yii\web\ForbiddenHttpException;
use yii\db\Expression;
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
    public function getUsersRequestsDashboard()
    {
        $dataUsers = User::find()->select([new Expression('COUNT(tbl_request.idRequest) AS total'), 'tbl_user.username'])
        ->rightJoin('tbl_request', 'tbl_user.idUser = tbl_request.idUser')
        ->orderBy('total asc')
        ->groupBy(['tbl_request.idUser'])
        ->limit(10)
        ->asArray()
        ->all();
        return $dataUsers;
    }
    public function getUsers()
    {
        return User::find()->count();
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
        if (\Yii::$app->user->can('criarUser')) 
        {
            $model = new User();
            if ($model->load(Yii::$app->request->post()))
            {      
                if($model->validate())
                {
                    $model->generateEmailVerificationToken();
                    if(UploadedFile::getInstance($model,'file'))
                    {
                        $model->file = UploadedFile::getInstance($model,'file');
                        $imageName = $model->username;
                        $model->photo = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' ,$imageName)) . '.' . $model->file->extension;
                        $model->save();
                        $model->file->saveAs('images/'. preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' ,$imageName)) .'.'. $model->file->extension);
                        return $this->redirect(['index']); 
                    }
                    $model->save();
                    return $this->redirect(['index']); 
                }    
                else
                {
                    return $this->render('create', [
                        'model' => $model,
                   ]);
                }    
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else  
        {
            throw new ForbiddenHttpException;
        }
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
        if (\Yii::$app->user->can('atualizarUser')) 
        {
            $session = Yii::$app->session;
            $model = $this->findModel($id);
            $session->set('id', $model->idUser);
            $oldImage = $model->photo;
            
            if ($model->load(Yii::$app->request->post())) {  
                if($model->validate())
                {
                    if(UploadedFile::getInstance($model, 'file'))
                    {
                        $imagem = UploadedFile::getInstance($model, 'file');
                        if($model->photo != '')
                        {
                            unlink(Yii::$app->basePath . '/web/' . $model->photo);
                        }
                        $imageName = $model->username;
                        $model->photo = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' ,$imageName)) . '.' . $imagem->extension;
                        $model->save(); 
                        $path = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $imageName)) . '.' . $imagem->extension;
                        $imagem->saveAs($path);
                        return $this->redirect(['index']);
                    }
                    else
                    {
                        $model->photo = $oldImage;
                    }
                    $model->save();
                    return $this->redirect(['index']);
                }
                else
                {
                    return $this->render('update', [
                        'model' => $model,
                   ]);
                }   
            } 
            else 
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            throw new ForbiddenHttpException;
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
        if (\Yii::$app->user->can('eliminarUser')) 
        {
            try 
            {
                $model = $this->findModel($id);
                $books = $model->ideaBook;
                $addresses = $model->addresses;
                $pedidos = $model->users;
                //testar se o user está relacionado noutra tabela 
                if($books != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este utilizador porque está inserido num ou mais livros de ideias!');
                    return $this->redirect(['index']);
                }
                else if($addresses != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este utilizador porque contém um ou mais endereços!');
                    return $this->redirect(['index']);
                }
                else if($pedidos != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este utilizador porque está associado a um ou mais pedidos!');
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
        else
        {
            throw new ForbiddenHttpException;
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
