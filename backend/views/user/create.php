<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->title = 'Criar utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
