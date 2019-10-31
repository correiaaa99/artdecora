<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Atualizar: ' . Yii::$app->user->identity->username;
?>
<div class="admin-update">

    <?= $this->render('_form', [
        'model' => Yii::$app->user->identity,
    ]) ?>

</div>
