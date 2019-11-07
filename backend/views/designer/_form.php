<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Designer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
    ];?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($model, 'name', $fieldOptions1)
        ->label('Nome * ')
        ->textInput(['placeholder' => $model->getAttributeLabel('Nome *')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
