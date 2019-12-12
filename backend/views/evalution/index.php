<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EvalutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avaliações';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evalution-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id_Project_User',
                'label' => 'Identificador',
            ],
            [
                'attribute' => 'name', //To display called value,
                'value' => 'project.name',
                'label' => 'Projeto',
            ],
            [
                'attribute' => 'username', //To display called value,
                'value' => 'user.username',
                'label' => 'Utilizador',
            ],  
            [
                'attribute' => 'evalution',
                'label' => 'Avaliação',
                'value' => function($model)
                {
                    return $model->evalution . ' ★';                        
                }
            ],
        

            ['class' => 'yii\grid\ActionColumn',
            'template' => '',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
