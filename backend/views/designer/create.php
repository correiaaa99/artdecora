<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Designer */

$this->title = 'Criar Designer';
$this->params['breadcrumbs'][] = ['label' => 'Designers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
