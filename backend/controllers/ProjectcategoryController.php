<?php

namespace backend\controllers;

use Yii;
use backend\models\Projectcategory;
use backend\models\ProjectcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\ForbiddenHttpException;


/**
 * ProjectcategoryController implements the CRUD actions for Projectcategory model.
 */
class ProjectcategoryController extends Controller
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
     * Lists all Projectcategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('verCategoriasProjeto')) 
        {
            $session = Yii::$app->session;
            $projeto = $session->get('projetoNome');
            $searchModel = new ProjectcategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'projeto' => $projeto,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Projectcategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('criarCategoriaProjeto')) 
        {
            $session = Yii::$app->session;
            $nomeProjeto = $session->get('projetoNome');
            $model = new Projectcategory();
            if ($model->load(Yii::$app->request->post())) {
                $projeto = $session->get('projeto');
                if($model->idCategory != null)
                {
                    foreach($model->idCategory as $value)
                    {
                        $model = new Projectcategory();
                        $model->idCategory = $value;
                        $model->idProject = $projeto;
                        $model->isNewRecord = true;
                        $model->save();
                    }
                }
                return $this->redirect(['index']); 
            }

            return $this->render('create', [
                'model' => $model,
                'projeto' => $nomeProjeto,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Projectcategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('eliminarCategoriaProjeto')) 
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Projectcategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projectcategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projectcategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
