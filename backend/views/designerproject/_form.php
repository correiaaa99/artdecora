<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Designerproject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="designerproject-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php 
        echo $form->field($model, 'idDesigner[]')
        ->label('Designer(s)')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\backend\models\designerproject::getDesigners(), 'idDesigner', 'name'),
            'options' => ['placeholder' => 'Seleciona um designer ...', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
   

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
