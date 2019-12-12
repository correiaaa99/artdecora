
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\controllers\AddressController;
/* @var $this yii\web\View */
/* @var $model backend\models\Request */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\User;
use yii\helpers\Url;
use backend\controllers\ImageController;
use kartik\file\FileInput;
?>

<div class="request-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => false]); ?>
    <small id="emailHelp" class="form-text text-muted">Campo de preenchimento obrigatório (*)</small>
    <p>
    <?= $form
        ->field($model, 'description')
        ->label('Descrição *')
        ->textArea() ?>
    <?php $dataProjects = ArrayHelper::map(\backend\models\Project::find()->asArray()->all(), 'idProject', 'name');?>
    <?php 
        echo $form->field($model, 'idProject')
        ->label('Projeto')
        ->widget(Select2::classname(), [
            'data' => $dataProjects,
            'options' => ['placeholder' => 'Seleciona um projeto ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?> 
    <?php $dataUser = ArrayHelper::map(\backend\models\User::find()->asArray()->all(), 'idUser', 'username');?>
    <?php echo $form->field($model, 'idUser')
        ->label('Utilizador *')
        ->widget(Select2::classname(), [
            'data' => $dataUser,
            'options' => ['placeholder' => 'Seleciona um utilizador ...' , 
            'onchange'=>'
             $.get( "'.Url::toRoute('/request/moradas').'", { id: $(this).val() } )
                 .done(function( data ) {
                     $( "#'.Html::getInputId($model, 'idAddress').'" ).html( data );
                 }
             );
           '    ],
        ]);
    ?>
    <?php 
        echo $form->field($model, 'idAddress')
        ->label('Endereço *')
        ->widget(Select2::classname(), [
            'options' => ['placeholder' => 'Selecione um endereço ...'],
        ]);
    ?> 
    <?php $estados = ['a' => 'Pendente', 'b' => 'Em processamento', 'c' => 'Finalizado'];?>
    <?php 
        echo $form->field($model, 'status')
        ->label('Estado *')
        ->widget(Select2::classname(), [
            'data' => $estados,
            'options' => ['placeholder' => 'Selecione um estado ...'],
        ]);
    ?> 
    <?php
    if($model->isNewRecord)
    {
        ?>
        <?php echo $form->field($image, 'file[]')
            ->label('Imagens * ')
            ->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*', 'multiple' => true],
        ]);?>
        <?php
    }?>
    <?php
    if(!$model->isNewRecord)
    {
        ?>
        <p>
        <?= Html::a('Imagens', ['image/index'], ['class' => 'btn btn-primary']) ?>
        <p>
        <?php
    }?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>