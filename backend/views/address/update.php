<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = 'Atualizar Endereço: ' . $model->address_name;
$this->params['breadcrumbs'][] = ['label' => 'Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->address_name, 'url' => ['view', 'id' => $model->idAddress]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="address-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
