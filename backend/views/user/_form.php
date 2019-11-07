<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
use kartik\date\DatePicker;
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
    <?php $fieldOptions5 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-calendar form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions6 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-phone form-control-feedback'></span>"
    ];?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($model, 'username', $fieldOptions1)
        ->label('Username *')
        ->textInput(['placeholder' => $model->getAttributeLabel('Username *')]) ?>    
     <?= $form
        ->field($model, 'name', $fieldOptions1)
        ->label('Nome')
        ->textInput(['placeholder' => $model->getAttributeLabel('Nome')]) ?>
    <?= $form
        ->field($model, 'surname', $fieldOptions1)
        ->label('Apelido')
        ->textInput(['placeholder' => $model->getAttributeLabel('Apelido')]) ?>
    <?= $form
        ->field($model, 'email', $fieldOptions4)
        ->label('Email *')
        ->textInput(['placeholder' => $model->getAttributeLabel('Email *')]) ?>
    
    <label>Data de nascimento</label>
    <?php
    echo DatePicker::widget([
        'model' => $model,
        'name' => 'birth_date', 
        'options' => ['placeholder' => 'Data de nascimento'],
        'pluginOptions' => [
            'format' => 'dd-M-yyyy',
            'todayHighlight' => true
        ]
    ]); ?>
    <br>
    <?= $form->field($model, 'telephone', $fieldOptions6)->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '999-999-999',
    ])
    ->label('Telemóvel') 
    ->textInput(['placeholder' => $model->getAttributeLabel('Telemóvel')]) ?>
    <?= $form
        ->field($model, 'password', $fieldOptions3)
        ->label('Palavra-passe * ')
        ->passwordInput(['placeholder' => $model->getAttributeLabel('Palavra-passe *')]) ?>
     <?= $form
        ->field($model, 'confirmpassword', $fieldOptions3)
        ->label('Confirma palavra-passe *')
        ->passwordInput(['placeholder' => $model->getAttributeLabel('Confirmar Palavra-passe *')]) ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
