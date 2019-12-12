<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */

$this->title = 'Atualizar pedido nº ' . $model->idRequest;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRequest, 'url' => ['view', 'id' => $model->idRequest]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="request-update">

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>
