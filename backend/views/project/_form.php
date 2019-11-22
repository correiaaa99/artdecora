<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Designer;
use backend\models\Category;
use kartik\number\NumberControl;
/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-home form-control-feedback'></span>"
    ];?>
    <?php $fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-calendar form-control-feedback'></span>"
    ];?>
     <?php $fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-euro form-control-feedback'></span>"
    ];?>
    <?php $form = ActiveForm::begin(); ?>

    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($project, 'name', $fieldOptions1)
        ->label('Nome *')
        ->textInput(['placeholder' => $project->getAttributeLabel('Nome *')]) ?> 
    <?php
         echo NumberControl::widget([
            'name' => 'normal-decimal',
            'value' => 43829.39,
        ]);   
    ?> 
    <?= $form
        ->field($project, 'price', $fieldOptions3)
        ->label('Preço *')
        ->textInput(['placeholder' => $project->getAttributeLabel('Preço *')]) ?> 
    <?= $form->field($project, 'description')->textarea(['rows' => 6]) ?>

    <?= $form
        ->field($project, 'date', $fieldOptions2)
        ->label('Data *')
        ->textInput(['placeholder' => $project->getAttributeLabel('Data *')]) ?> 
    <?php $designers = ArrayHelper::map(\backend\models\Designer::find()->orderBy('idDesigner')->all(), 'idDesigner', 'name') ?>
    <?= $form->field($designer, 'idDesigner')
    ->dropDownList($designers,
     [
        'multiple'=>'multiple',     
    ],
    ['prompt' => '---- Selecione o(s) designer(s) ----'])->label('Designer(s) *') ?>
    <?php $categorias = ArrayHelper::map(\backend\models\Category::find()->orderBy('idCategory')->all(), 'idCategory', 'name') ?>
    <?= $form->field($category, 'idCategory')
    ->dropDownList($categorias,
     [
        'multiple'=>'multiple',     
    ],
    ['prompt' => '---- Selecione a(s) categoria(s) ----'])->label('Categoria(s) *') ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
