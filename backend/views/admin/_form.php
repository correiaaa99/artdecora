<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
use kartik\password\PasswordInput;
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];?>
<?php $fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];?>
<?php $fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-key form-control-feedback'></span>"
];?>
    <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label('Nome')
            ->textInput(['placeholder' => $model->getAttributeLabel('Nome')]) ?>
    <?= $form
            ->field($model, 'email', $fieldOptions2)
            ->label('Email')
            ->textInput(['placeholder' => $model->getAttributeLabel('Email')]) ?>         
    <?php 
        $model->password_hash='';
        echo $form->field($model, 'password_hash')
        ->label('Palavra-passe *')
        ->hint('Mínimo = 6 carateres | 1 dígito | 1 caráter maiúsculo e 1 minúsculo')
        ->widget(PasswordInput::classname(), [
        'pluginOptions' => [
            'showMeter' => false,
            'toggleMask' => true
        ]
    ]);?>   
     <?php 
        echo $form->field($model, 'confirmpassword')
        ->label('Confirma palavra-passe *')
        ->widget(PasswordInput::classname(), [
        'pluginOptions' => [
            'showMeter' => false,
            'toggleMask' => true
        ]
    ]);?>    
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
