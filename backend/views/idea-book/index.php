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
                'label' => 'Username',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
