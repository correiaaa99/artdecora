<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectcategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adicionar categorias ao projeto: ' . $projeto ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectcategory-index">


    <p>
        <?= Html::a('Adicionar categorias', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name', //To display called value,
                'value' => 'category.name',
                'label' => 'Categoria',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
