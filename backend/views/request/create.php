<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Request */

$this->title = 'Criar pedido';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>
