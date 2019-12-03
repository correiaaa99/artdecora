<?php

namespace backend\controllers;

use Yii;
use backend\models\Project;
use backend\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Designerproject;
use backend\models\Projectcategory;
use backend\models\Image;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use yii\web\Session;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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

    public function getProjects()
    { 
        return Project::find()->count();
    }
    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('criarProjeto')) 
        {
            $image = new Image();
            $project = new Project();
            $project_category = new Projectcategory();
            $project_designer = new Designerproject();
            if ($project->load(Yii::$app->request->post()))
            {
                $project->save(false);
                if($project_designer->load(Yii::$app->request->post()))
                {
                    foreach($project_designer->idDesigner as $value)
                    {
                        $project_designer = new Designerproject();  
                        $project_designer->idDesigner = $value;
                        $project_designer->idProject = $project->idProject;
                        $project_designer->isNewRecord = true;
                        $project_designer->save();
                    } 
                }
                if($project_category->load(Yii::$app->request->post()))
                {
                    foreach($project_category->idCategory as $value)
                    {
                        $project_category = new Projectcategory();  
                        $project_category->idCategory = $value;
                        $project_category->idProject = $project->idProject;
                        $project_category->isNewRecord = true;
                        $project_category->save();
                    } 
                }
                if($image->load(Yii::$app->request->post()))
                {
                    $image->file = UploadedFile::getInstances($image, 'file');
                    foreach($image->file as $file)
                    {
                        $image = new Image();
                        $image->name = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension;
                        $image->idProject = $project->idProject;
                        $image->isNewRecord = true;
                        $image->save(false);
                        $path = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension;
                        $file->saveAs($path);
                    }
                }
                return $this->redirect(['index']);
            }   
            return $this->render('create', [
                'project' => $project,
                'designer'=> $project_designer,
                'category' => $project_category,
                'image' => $image,
            ]);
        } 
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('atualizarProjeto')) 
        {
            $session = Yii::$app->session;
            $project = $this->findModel($id);
            $project_category = new Projectcategory();
            $project_designer = new Designerproject();
            $image = new Image();
            $session->set('projeto', $project->idProject);
            $session->set('projetoNome', $project->name);
            if ($project->load(Yii::$app->request->post()) && $project->save()) {
                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'project' => $project,
                'designer' => $project_designer,
                'category' => $project_category,
                'image' => $image,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        if (\Yii::$app->user->can('eliminarProjeto')) 
        {
            try 
            {
                $model = $this->findModel($id);
                $images = $model->images;
                $designers = $model->designers;
                $categorys = $model->categorys;
                if($images != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este projeto porque tem imagens associadas!');
                    return $this->redirect(['index']);
                }
                else if($designers != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este projeto porque tem designers associados!');
                    return $this->redirect(['index']);
                }
                else if($categorys != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este projeto porque tem categorias associadas!');
                    return $this->redirect(['index']);
                }
                else
                {
                    $this->findModel($id)->delete();
                    return $this->redirect(['index']);
                }
            }
            catch(\yii\db\IntegrityException $e)
            {
                \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este projeto!');
                return $this->redirect(['index']);
            }
        } 
        else 
        {
            throw new ForbiddenHttpException;
        }

    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
