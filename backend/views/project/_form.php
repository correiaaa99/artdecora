<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Designer;
use backend\models\Category;
use kartik\number\NumberControl;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;

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
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($project, 'name', $fieldOptions1)
        ->label('Nome *')
        ->textInput(['placeholder' => $project->getAttributeLabel('Nome *')]) ?> 

    <?php 
    echo $form->field($project, 'price')
    ->label('Preço *')
    ->widget(NumberControl::classname(), [
    'value' => null,
    'maskedInputOptions' => [
        'suffix' => ' €',
        'allowMinus' => false,  
    ],
    ]);?>
    <?= $form
        ->field($project, 'description')
        ->label('Descrição *')
        ->textArea(['rows' => 6]) ?>
    <?= $form->field($project, 'date')
        ->label('Data *')
        ->widget(
        DatePicker::className(), [
            'options' => ['placeholder' => 'Data'],
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true,

            ]
    ]);?>
    <?php
    if($project->isNewRecord)
    {
        ?>
        <?php $designers = ArrayHelper::map(\backend\models\Designer::find()->orderBy('idDesigner')->all(), 'idDesigner', 'name')?>
        <?php echo $form->field($designer, 'idDesigner')
        ->label('Designer(s)')
        ->widget(Select2::classname(), [
            'data' => $designers,
            'options' => ['placeholder' => 'Seleciona um designer ...', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);?>
     
        <?php $categorias = ArrayHelper::map(\backend\models\Category::find()->orderBy('idCategory')->all(), 'idCategory', 'name')?>
        <?php echo $form->field($category, 'idCategory')
        ->label('Categoria(s)')
        ->widget(Select2::classname(), [
            'data' => $categorias,
            'options' => ['placeholder' => 'Seleciona uma categoria ...', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        echo $form->field($image, 'file[]')
        ->label('Imagens')
        ->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        ]);
    }
    ?>
    <?php
    if(!$project->isNewRecord)
    {
        ?>
        <?= Html::a('Designer(s)', ['designerproject/index'], ['class' => 'btn btn-primary']) ?>
        <p>
        <p>
        <?= Html::a('Categoria(s)', ['projectcategory/index'], ['class' => 'btn btn-primary']) ?>
        <p>
        <?= Html::a('Imagens', ['image/index'], ['class' => 'btn btn-primary']) ?>
        <p>
        <?php
    }
    ?>
    

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
