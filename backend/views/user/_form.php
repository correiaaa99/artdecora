<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php $fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-picture form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-key form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions4 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-envelope form-control-feedback'></span>"
    ];?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($model, 'username', $fieldOptions1)
        ->label(false)
        ->textInput(['placeholder' => $model->getAttributeLabel('Username *')]) ?>    
     <?= $form
        ->field($model, 'name', $fieldOptions1)
        ->label(false)
        ->textInput(['placeholder' => $model->getAttributeLabel('Nome')]) ?>
    <?= $form
        ->field($model, 'surname', $fieldOptions1)
        ->label(false)
        ->textInput(['placeholder' => $model->getAttributeLabel('Apelido')]) ?>
    <?= $form
        ->field($model, 'photo', $fieldOptions2)
        ->label(false)
        ->textInput(['placeholder' => $model->getAttributeLabel('Foto')]) ?>
    <?= $form
        ->field($model, 'email', $fieldOptions4)
        ->label(false)
        ->textInput(['placeholder' => $model->getAttributeLabel('Email *')]) ?>
    <?= $form
        ->field($model, 'password', $fieldOptions3)
        ->label(false)
        ->passwordInput(['placeholder' => $model->getAttributeLabel('Palavra-passe *')]) ?>
     <?= $form
        ->field($model, 'confirmpassword', $fieldOptions3)
        ->label(false)
        ->passwordInput(['placeholder' => $model->getAttributeLabel('Confirmar Palavra-passe *')]) ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
