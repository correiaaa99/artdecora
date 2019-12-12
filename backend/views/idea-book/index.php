<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\IdeaBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Livros de ideias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="idea-book-index">
    <?php if (Yii::$app->session->hasFlash('erro')): ?>
    <div class="alert alert-error alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-close"></i>Erro</h4>
         <?= Yii::$app->session->getFlash('erro') ?>
    </div>
    <?php endif; ?>
    <p>
        <?= Html::a('Criar livro de ideias', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=> 'idBook',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'title',
                'label' => 'Título',
            ],
            [
                'attribute'=> 'description',
                'label' => 'Descrição',
            ],
            [
                'attribute' => 'username', //To display called value,
                'value' => 'user.username',
                'label' => 'Utilizador',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
