<?php

namespace backend\controllers;

use Yii;
use backend\models\ProjectIdeaBook;
use backend\models\ProjectIdeaBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\web\ForbiddenHttpException;

/**
 * ProjectIdeaBookController implements the CRUD actions for ProjectIdeaBook model.
 */
class ProjectIdeaBookController extends Controller
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
     * Lists all ProjectIdeaBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('verProjetosLivro')) 
        {
            $session = Yii::$app->session;
            $livro = $session->get('nomeLivro');
            $searchModel = new ProjectIdeaBookSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'livro' => $livro
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single ProjectIdeaBook model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('verProjetosLivro')) 
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
     * Creates a new ProjectIdeaBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('criarProjetoLivro')) 
        {
            $model = new ProjectIdeaBook();
            $session = Yii::$app->session;
            $livro = $session->get('nomeLivro');
            if ($model->load(Yii::$app->request->post())) {
                $idLivro = $session->get('livro');
                $model->idBook = $idLivro;
                $model->save();
                return $this->redirect(['index']);
            }

            return $this->render('create', [
                'model' => $model,
                'livro' => $livro,
            ]); 
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing ProjectIdeaBook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('atualizarProjetoLivro')) 
        {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Deletes an existing ProjectIdeaBook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('eliminarProjetoLivro')) 
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
     * Finds the ProjectIdeaBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectIdeaBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectIdeaBook::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
