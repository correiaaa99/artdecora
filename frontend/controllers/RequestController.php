<?php

namespace frontend\controllers;
use frontend\models\Request;
use Yii;
use frontend\models\Image;
use yii\web\UploadedFile;
class RequestController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','create', 'view'],
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
    public function actionIndex()
    {
        $pedidos = Request::find()
        ->select('tbl_request.status as estado, tbl_request.description as descricao, tbl_request.idRequest, tbl_address.address_name, tbl_project.name')
        ->innerJoin('tbl_user', 'tbl_user.idUser = tbl_request.idUser')
        ->innerJoin('tbl_address', 'tbl_address.idAddress = tbl_request.idAddress')
        ->leftJoin('tbl_project', 'tbl_project.idProject = tbl_request.idProject')
        ->where(['tbl_request.idUser' => Yii::$app->user->identity->id])
        ->orderBy('idRequest desc')
        ->asArray()
        ->all();
        return $this->render('index', [
            'pedidos' => $pedidos,
        ]);
    }
    public function actionView($id)
    {
        $request = Request::find()
        ->select('tbl_request.idUser, tbl_request.status as estado, tbl_request.description as descricao, tbl_request.idRequest, tbl_address.address_name as endereco, tbl_project.name')
        ->innerJoin('tbl_user', 'tbl_user.idUser = tbl_request.idUser')
        ->innerJoin('tbl_address', 'tbl_address.idAddress = tbl_request.idAddress')
        ->leftJoin('tbl_project', 'tbl_project.idProject = tbl_request.idProject')
        ->where(['tbl_request.idRequest' => $id])
        ->limit(1)
        ->one();
        if($request)
        {
            if($request->idUser == Yii::$app->user->identity->id)
            {
                return $this->render('view', [
                    'request' => $request,
                ]);
            }
            else
                return $this->redirect(['request/index']); 
        }
        else
            return $this->redirect(['request/index']); 
    }
    public function actionCreate($projeto)
    {
        $request = new Request();
        $image = new Image();
        if ($request->load(Yii::$app->request->post())) {
            if($projeto != null)
            {
                $request->idProject = $projeto;
            }
            if($request->idAddress == null)
            {
                Yii::$app->session->setFlash('endereconull', 'endereconull');
                return $this->redirect(['user/update']);
            }
            $request->status = 'a';
            $request->idUser = Yii::$app->user->identity->id;
            $request->save(false);
            if($image->load(Yii::$app->request->post()))
            {
                $image->file = UploadedFile::getInstances($image, 'file');
                $basePath = str_replace(DIRECTORY_SEPARATOR.'protected', "", str_replace('frontend', '', Yii::$app->basePath));
                $uploadDir = 'backend/web/images/';
                $folder = 'backend/web/';
                foreach($image->file as $file)
                {
                    $image = new Image();
                    $image->name = 'images/' .  preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' ,$file->baseName)) . '.' . $file->extension;
                    $image->idRequest = $request->idRequest;
                    $image->isNewRecord = true;
                    $image->save(false);
                    $file->saveAs($basePath .$uploadDir.preg_replace("/[^a-zA-Z0-9.]/", "",str_replace(' ', '_' , $file->baseName)) . '.' . $file->extension);
                }
            }
            Yii::$app->session->setFlash('pedidoinserido', 'pedidoinserido');
            return $this->redirect(['request/index']);
        }
        return $this->render('create', [
            'request' => $request,
            'image' => $image,
        ]);
    }
}
