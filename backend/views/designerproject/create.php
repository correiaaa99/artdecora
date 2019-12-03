<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Designerproject */

$this->title = 'Adicionar designer ao projeto: ' . $projeto;
$this->params['breadcrumbs'][] = ['label' => 'Designers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designerproject-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
