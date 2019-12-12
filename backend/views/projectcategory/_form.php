<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Projectcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectcategory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        echo $form->field($model, 'idCategory[]')
        ->label('Categoria(s)')
        ->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\backend\models\Projectcategory::getCategorys(), 'idCategory', 'name'),
            'options' => ['placeholder' => 'Seleciona uma categoria ...', 'multiple' => true],
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
