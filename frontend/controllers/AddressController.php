<?php

namespace frontend\controllers;
use frontend\models\Address;
use Yii;
use yii\web\NotFoundHttpException;
class AddressController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['update', 'delete', 'create'],
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
        return $this->render('index');
    }
    public function actionUpdate($id)
    {
        $addressUpdate = $this->findModel($id);
        if(Yii::$app->request->isAjax)  {
            $data = Yii::$app->request->post();
            $address = $data['address'];
            $city = $data['city'];
            $zip = $data['zip'];
            $addressUpdate->address_name = $address;
            $addressUpdate->city = $city;
            $addressUpdate->zip_code = $zip;
           if($addressUpdate->save())
           {
               return "alterado";
           }
        }
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $enderecos = $model->addresses;
        if($enderecos != null)
        {
            return "naoeliminado";
        }
        else
        {
            $this->findModel($id)->delete();
            return "eliminado";
        }
    }
    public function actionCreate()
    {
        $address = new Address();
        if($address->load(Yii::$app->request->post()))
        {
            $address->idUser = Yii::$app->user->identity->id; 
            if($address->validate())
            {
                if($address->save())
                {
                    Yii::$app->session->setFlash('enderecoInserido', 'enderecoInserido');
                    return $this->redirect(['user/update']);
                }
            }
            else
            {
                Yii::$app->session->setFlash('enderecoigual', 'enderecoigual');
                return $this->redirect(['user/update']);
            }
        }
    }
    protected function findModel($id) {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }   

}
