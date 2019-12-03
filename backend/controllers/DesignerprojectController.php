<?php

namespace backend\controllers;

use Yii;
use backend\models\Designerproject;
use backend\models\DesignerprojectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
/**
 * DesignerprojectController implements the CRUD actions for Designerproject model.
 */
class DesignerprojectController extends Controller
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
     * Lists all Designerproject models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('verDesignersProjeto')) 
        {
            $session = Yii::$app->session;
            $projeto = $session->get('projetoNome');
            $searchModel = new DesignerprojectSearch();
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
     * Creates a new Designerproject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('criarDesignerProjeto')) 
        {
            $session = Yii::$app->session;
            $nomeProjeto = $session->get('projetoNome');
            $model = new Designerproject();
            if ($model->load(Yii::$app->request->post())) {
                $projeto = $session->get('projeto');
                if($model->idDesigner != null)
                {
                    foreach($model->idDesigner as $value)
                    {
                        $model = new Designerproject();
                        $model->idDesigner = $value;
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
     * Deletes an existing Designerproject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('eliminarDesignerProjeto')) 
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
     * Finds the Designerproject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Designerproject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Designerproject::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
