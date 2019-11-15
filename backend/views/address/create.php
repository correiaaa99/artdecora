<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = 'Criar endereço';
$this->params['breadcrumbs'][] = ['label' => 'Endereço', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
