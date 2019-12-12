<?php

namespace backend\controllers;

use Yii;
use backend\models\Image;
use backend\models\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('verImagens')) 
        { 
            $searchModel = new ImageSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Image model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('verImagens')) 
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }

    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        if (\Yii::$app->user->can('criarImagem')) 
        {  
            $model = new Image();
            if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstances($model, 'file');
                foreach($model->file as $file)
                {
                    $model = new Image();
                    $session = Yii::$app->session;
                    $projeto = $session->get('projeto');
                    $pedido = $session->get('pedido');
                    if($projeto != null)
                    {
                        $model->idProject = $projeto;
                    }
                    else
                    {
                        $model->idRequest = $pedido;
                    }
                    $model->name = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension;
                    $model->save(false);
                    $path = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension;
                    $file->saveAs($path);
                }
                return $this->redirect(['index']);
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
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('atualizarImagem')) 
        { 
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                unlink(Yii::$app->basePath . '/web/' . $model->name);
                $image = UploadedFile::getInstance($model, 'file');
                if(UploadedFile::getInstance($model, 'file'))
                {               
                    $model->name = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $image->baseName)) . '.' . $image->extension;
                }
                $model->save(false);
                $path = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $image->baseName)) . '.' . $image->extension;
                $image->saveAs($path);
                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('eliminarImagem')) 
        { 
            $model = $this->findModel($id);
            if($model->name != '')
            {
                unlink(Yii::$app->basePath . '/web/' . $model->name);
            }
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
