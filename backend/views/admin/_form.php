<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
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
     <?= $form->field($model, 'password_hash')->passwordInput(['placeholder' => Yii::t('app', 'Password'), 'value' => ''])->label('Palavra-passe') ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
