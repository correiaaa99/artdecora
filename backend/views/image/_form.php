<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model->isNewRecord)
    {
        echo $form->field($model, 'file[]')
        ->label('Imagens')
        ->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        ]);
    }?>
    <?php if(!$model->isNewRecord)
    {
        echo $form->field($model, 'file')
        ->label('Imagens')
        ->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        ]);
    }?>
    <div class="form-group">
        <?= Html::submitButton('Adicionar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
