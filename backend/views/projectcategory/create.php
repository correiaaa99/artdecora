<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Projectcategory */

$this->title = 'Adicionar categoria ao projeto: ' . $projeto;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectcategory-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
