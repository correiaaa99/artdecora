<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $fieldOptions1 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-home form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions2 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='fa fa-building form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions3 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope	
        form-control-feedback'></span>"
    ];?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($model, 'name', $fieldOptions1)
        ->label('Endereço *')
        ->textInput(['placeholder' => $model->getAttributeLabel('Endereço *')]) ?> 
    <?= $form
        ->field($model, 'city', $fieldOptions2)
        ->label('Cidade *')
        ->textInput(['placeholder' => $model->getAttributeLabel('Cidade *')]) ?> 
    <?= $form->field($model, 'zip_code', $fieldOptions3)->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '9999-999',
    ])
    ->label('Código Postal *') 
    ->textInput(['placeholder' => $model->getAttributeLabel('Código Postal *')]) ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
