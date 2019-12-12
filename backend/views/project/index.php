<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use backend\models\Designerproject;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projetos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
    <?php if (Yii::$app->session->hasFlash('erro')): ?>
    <div class="alert alert-error alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-close"></i>Erro</h4>
         <?= Yii::$app->session->getFlash('erro') ?>
    </div>
    <?php endif; ?>
    <p>
        <?= Html::a('Criar projeto', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=> 'idProject',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Nome',
            ],
            [
                'attribute'=> 'price',
                'label' => 'Preço',
                'value' => function($model)
                {
                    return $model->price . ' €';   
                }
            ],
            [
                'attribute'=> 'description',
                'label' => 'Descrição',
            ],
            [
                'attribute'=> 'date',
                'label' => 'Data',
            ],
            [
                'label' => 'Designer(s)',
                'value' => function($model)
                {
                    $designer = [];
                    if($model->designers != null)
                    {
                        foreach($model->designers as $designer) {
    
                            $designers[] = $designer->name;
                         }
                         return implode(', ', $designers);
                    }
                    else
                    {        
                        return 'Não há designers';
                    }
                    
                },
            ],
            [
                'label' => 'Categoria(s)',
                'value' => function($model)
                {
                    $category = [];
                    if($model->categorys != null)
                    {
                        foreach($model->categorys as $category) {
        
                            $categorys[] = $category->name;
                        }
                        return implode(', ', $categorys);
                    }
                    else
                    {        
                        return 'Não há categorias';
                    }
                    
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
