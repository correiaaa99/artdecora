<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectIdeaBook */

$this->title = 'Adicionar projeto ao livro de ideias: ' . $livro;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-idea-book-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
