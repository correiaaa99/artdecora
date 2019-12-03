<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectIdeaBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-idea-book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idProject')->textInput() ?>

    <?= $form->field($model, 'idBook')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
