<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\ProjectIdeaBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-idea-book-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php $fieldOptions1 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-book form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions2 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-bookmark form-control-feedback'></span>"
    ];?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($model, 'title', $fieldOptions1)
        ->label('Título *')
        ->textInput(['placeholder' => $model->getAttributeLabel('Título *')]) ?> 

    <?= $form
        ->field($model, 'comment', $fieldOptions2)
        ->label('Comentário *')
        ->textArea(['placeholder' => $model->getAttributeLabel('Comentário *')]) ?> 

    <?php $projetos = ArrayHelper::map(\backend\models\Project::find()->orderBy('idProject')->all(), 'idProject', 'name') ?>
    <?php
        echo $form->field($model, 'idProject')
        ->label('Projeto')
        ->widget(Select2::classname(), [
            'data' => $projetos,
            'options' => ['placeholder' => 'Seleciona um projeto ...'],
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
