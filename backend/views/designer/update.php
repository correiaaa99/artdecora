<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Designer */

$this->title = 'Atualizar Designer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Designers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idDesigner]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="designer-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
