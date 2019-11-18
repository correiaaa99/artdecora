<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IdeaBook */

$this->title = 'Atualizar livro de ideias: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Livros de ideias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->idBook]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="idea-book-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
