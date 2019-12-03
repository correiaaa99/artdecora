<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Image */

$this->title = 'Atualizar imagem';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idImage]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="image-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
