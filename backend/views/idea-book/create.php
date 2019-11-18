<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IdeaBook */

$this->title = 'Criar livro de ideias';
$this->params['breadcrumbs'][] = ['label' => 'Livros de ideias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="idea-book-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
