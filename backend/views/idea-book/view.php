<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IdeaBook */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Idea Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="idea-book-view">
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idBook], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idBook], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar este livro de ideias?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'attribute'=> 'date',
                'label' => 'Data',
            ],
            [
                'attribute' => 'user.username', //To display called value,
                'label' => 'Utilizador',
            ],
        ],
    ]) ?>

</div>
