<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectIdeaBook */

$this->title = 'Update Project Idea Book: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Project Idea Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_Project_idea_book]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-idea-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
