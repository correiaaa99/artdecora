<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectIdeaBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adicionar projetos ao livro de ideias: ' . $livro;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-idea-book-index">
    <p>
        <?= Html::a('Adicionar projeto', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id_Project_idea_book', 
                'label' => 'Identificador',
            ],
            [
                'attribute' => 'title', 
                'label' => 'Título',
            ],
            [
                'attribute' => 'comment', 
                'label' => 'Comentário',
            ],
            [
                'attribute' => 'name', //To display called value,
                'value' => 'project.name',
                'label' => 'Projeto',
            ], 

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
