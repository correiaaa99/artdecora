<?php

namespace backend\controllers;

use Yii;
use backend\models\Request;
use backend\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\AddressController;
use backend\models\Address;
use backend\models\Image;       
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;
use yii\web\Session;
/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
    public function getRequestDashboards()
    {
        $pedidos = Request::find()
        ->select('tbl_request.status as estado, tbl_request.description as descricao, tbl_request.idRequest, tbl_user.username, tbl_address.address_name, tbl_project.name')
        ->innerJoin('tbl_user', 'tbl_user.idUser = tbl_request.idUser')
        ->innerJoin('tbl_address', 'tbl_address.idAddress = tbl_request.idAddress')
        ->leftJoin('tbl_project', 'tbl_project.idProject = tbl_request.idProject')
        ->limit(10)
        ->orderBy('idRequest desc')
        ->asArray()
        ->all();

        return $pedidos;
    }
    public function getRequests()
    { 
        return Request::find()->count();
    }
    public function actionMoradas($id)
    {
        $addresses = \backend\models\Address::find()
        ->where(['idUser' => $id])
        ->all();
        if (!empty($addresses)) {
            foreach($addresses as $address) {
                echo "<option value='".$address->idAddress."'>".$address->address_name. ' (' . $address->city . ' , ' . $address->zip_code . ')'. "</option>";
            }
        } else {
            echo "<option>Não há endereços</option>";
        }
    }
    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
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
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('criarPedido')) 
        {
            $model = new Request();
            $image = new Image();
            if ($model->load(Yii::$app->request->post())) {
                $model->save(false);
                if($image->load(Yii::$app->request->post()))
                {
                    $image->file = UploadedFile::getInstances($image, 'file');
                    foreach($image->file as $file)
                    {
                        $image = new Image();
                        $image->name = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension;
                        $image->idRequest = $model->idRequest;
                        $image->isNewRecord = true;
                        $image->save(false);
                        $path = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension;
                        $file->saveAs($path);
                    }
                }
                return $this->redirect(['index']);
            }

            return $this->render('create', [
                'model' => $model,
                'image' => $image,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('atualizarPedido')) 
        {
            $session = Yii::$app->session;
            $model = $this->findModel($id);
            $image = new Image();
            $session->set('pedido', $model->idRequest);
            $session->remove('projeto');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
                'image' => $image,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('eliminarPedido')) 
        {
            try
            {   
                $model = $this->findModel($id);
                $images = $model->images;
                if($images != null)
                {
                    \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este pedido porque tem imagens associadas!');
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
                \Yii::$app->session->setFlash('erro', 'Não é possível eliminar este pedido!');
                return $this->redirect(['index']);
            }
        
        }
        else
        {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
