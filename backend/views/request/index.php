<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">
<?php if (Yii::$app->session->hasFlash('erro')): ?>
    <div class="alert alert-error alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-close"></i>Erro</h4>
         <?= Yii::$app->session->getFlash('erro') ?>
    </div>
    <?php endif; ?>
    <p>
        <?= Html::a('Criar pedido', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'idRequest',
                'label' => 'Identificador',
            ],
            [
                'attribute' => 'description',
                'label' => 'Descrição',
            ],
            [
                'attribute' => 'status',
                'label' => 'Estado',
                'value' => function($model)
                {
                    if($model->status == 'a')
                    {
                        return 'Pendente';
                    }
                    else if($model->status == 'b')
                    {
                        return 'Em processamento';
                    }
                    else 
                    {
                        return 'Finalizado';
                    }
                }
                
            ],
            [
                'attribute' => 'username', //To display called value,
                'value' => 'user.username',
                'label' => 'Utilizador',
            ],
            [
                'attribute' => 'address_name', //To display called value,
                'value' => 'address.address_name',
                'label' => 'Endereço',
            ],
            [
                'attribute' => 'name', //To display called value,
                'label' => 'Projeto',
                'format'    => 'raw',
                'value'     => function ($model) {
                    if ($model->idProject != null) {
                        return $model->project->name;          
                    } else {
                        return '';
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
