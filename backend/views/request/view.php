<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */

$this->title = 'Pedido nº ' . $model->idRequest;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idRequest], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idRequest], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar este pedido?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'idRequest',
                'label' => 'Identificador',
            ],
            [
                'attribute' => 'description', 
                'label' => 'Descrição',
            ],
            [
                'attribute' => 'user.username', 
                'label' => 'Utilizador',

            ],
            [   
                'label' => 'Projeto',
                'value' => function($model)
                {
                    $array = [];
                    if($model->project == null)
                    {
                        array_push($array, ' ');
                    }
                    else 
                    {
                        array_push($array, $model->project->name);
                    }
                    return implode(' ' ,$array);
                },

            ],
            [
                'attribute' => 'address.address_name',
                'label' => 'Endereço',

            ],
            [
                'label' => 'Estado',
                'value' => function($model)
                {
                    $array = [];
                    if($model->status == 'a')
                    {
                        array_push($array, 'Pendente');
                    }
                    else if($model->status == 'b')
                    {
                        array_push($array, 'Em processamento');
                    }
                    else if($model->status == 'c')
                    {
                        array_push($array, 'Finalizado');
                    }
                    return implode(' ', $array); 
                }, 
            ], 
            [               
                'label' => 'Imagens',
                'value' => function($model){
                    $images = array();
                    foreach ($model->images as $image) {
                        array_push($images, Html::img(Yii::getAlias('@web').'/' . $image->name,  ['width'=>'100','height'=>'90']));
                    }
                    return implode(', ', $images);
                    
                },
                'format'=>'raw',       
            ],
        ],
    ]) ?>

</div>
