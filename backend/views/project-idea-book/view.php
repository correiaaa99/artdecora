<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectIdeaBook */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projeto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-idea-book-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_Project_idea_book], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id_Project_idea_book], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar este projeto deste livro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id_Project_idea_book',
                'label' => 'Identificador'
            ],
            [
                'attribute' => 'title',
                'label' => 'Título'
            ],
            [
                'attribute' => 'comment',
                'label' => 'Comentário'
            ],
            [
                'attribute' => 'project.name', //To display called value,
                'label' => 'Projeto',
            ],
        ],
    ]) ?>

</div>
