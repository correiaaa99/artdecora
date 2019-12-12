<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\User;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\IdeaBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="idea-book-form">

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
        ->field($model, 'description', $fieldOptions2)
        ->label('Descrição *')
        ->textArea(['rows' => 6]) ?>
    <?php $utilizadores = ArrayHelper::map(\backend\models\User::find()->orderBy('idUser')->all(), 'idUser', 'username') ?>
    <?= $form->field($model, 'idUser')
    ->dropDownList($utilizadores, ['prompt' => '---- Selecionar o utilizador ----'])->label('Utilizador *') ?>
    <?php
    if(!$model->isNewRecord)
    {
        ?>
        <?= Html::a('Adicionar projetos', ['project-idea-book/index'], ['class' => 'btn btn-primary']) ?>
        <?php
    }
    ?>
    <p>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
