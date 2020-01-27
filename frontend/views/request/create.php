<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;
?>
<style> 
    .container {
        background: white;
        padding: 20px 25px;
        border: 5px solid #BD9056;
        width: 90%;
        height: auto;
        box-sizing: border-box;
        position: relative;
        margin-top:0.7%;
    }
    .col.s6 > .btn {
        width: 100%;
    }
    .container {
        animation: showUp 0.5s cubic-bezier(0.18, 1.3, 1, 1) forwards;
    }
    @keyframes showUp 
    {
        0% 
        {
            transform: scale(0);
        }
        100% 
        {
            transform: scale(1);
        }
    }
    .row {margin-bottom: 10px;}
    .ngl {
        position: absolute;
        top: -20px;
        right: -20px;
    }
    @media only screen and (max-width: 992px) {
        .input-field .prefix ~ input 
        {
            width: 86%;
            width: calc(100% - 3rem); 
        } 
    }
    .info {
        font-weight:bold;
        font-size:18px;
        font-family:Century Gothic;
    }
    .btn {
        background-color:#5e482b; 

    }
    .btn:hover {
        background-color:#715633;
        color:white;
    }
    .centerize {
        text-align:center;
    }
    #description:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
</style>
<div class="request-create">
    <div class="container">  
        <h4 style="text-align:center;font-size:30px;font-weight:550;">Novo pedido</h4>
        <p style="text-align:center;font-weight:500;font-size:16px;">Adicione imagens da sua área para uma melhor observação.</p>
        <div class="row">
            <?php $form = ActiveForm::begin(['class' => 'col s12']); ?>
                <div class="row">
                    <div class=" input-field col m12 s12">
                        <?= $form->field($request, 'description')->textarea([   
                            'id' => 'description',
                        ]) 
                        ->label('Descrição')?>
                    </div>
                </div>
                <div class="row">
                    <div class=" input-field col m12 s12">
                        <?php $enderecos = ArrayHelper::map(\frontend\models\Address::find()->where(['idUser' => Yii::$app->user->identity->id])->orderBy('idAddress')->all(), 'idAddress', 'address_name') ?>
                        <?php echo $form->field($request, 'idAddress')
                        ->label('Endereço')
                        ->widget(Select2::classname(), [
                            'data' => $enderecos,
                            'options' => ['placeholder' => 'Selecione um endereço'],
                            'id' => 'idAddress'
                        ]);?>
                    </div>      
                </div>
                <div class="row">
                    <div class="input-field col m12 s12">
                        <?php echo $form->field($image, 'file[]')
                            ->label('Imagens * ')
                            ->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*', 'multiple' => true],
                        ]);?>
                    </div>
                </div>
                <div class="row">   
                    <div class="input-field col m4 s12"></div>
                    <div class="input-field col m4 s12 centerize">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="input-field col m4 s12"></div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
