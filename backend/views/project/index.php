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
                        foreach($model->designers as $designer) {
        
                           $designers[] = $designer->name;
                        }
                        return implode(', ', $designers);
                     },
             ],
             [

                'label' => 'Categoria(s)',
                'value' => function($model)
                    {
                        $category = [];
                        foreach($model->categorys as $category) {
        
                           $categorys[] = $category->name;
                        }
                        return implode(', ', $categorys);
                     },
             ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
