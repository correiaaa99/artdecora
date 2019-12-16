<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use developit\captcha\Captcha;
?>
<style> 
    .container {
        background: white;
        padding: 20px 25px;
        border: 5px solid #BD9056;
        width: 65%;
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
    @media only screen and (max-width: 600px) {
        .input-field .prefix ~ input 
        {
            width: 100%;
            width: calc(100% - 3rem); 
        } 
    }
    @media only screen and (max-width: 600px) {
        .container {
            width:90%;
        }
    }
    .btn {
        background-color:#5e482b; 

    }
    .btn:hover {
        background-color:#715633
    }
    .centerize {
        margin-top:-15px;
        text-align:center;
    }
    #email:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #name:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #body:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #subject:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #contactform-verifycode:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
</style>
<div class="site-contact">
    <div class="container">
        <img style="margin-left:42%;height:12%;width:12%" src="/imagens/site/message.png">
        <p style="text-align:center;">Se você tiver dúvidas comerciais ou outras questões, preencha o formulário para entrar em contato. Obrigado.</p>
        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => 'col s12']); ?>
                <div class="row">
                    <div class=" input-field col m6 s12">
                        <?= $form->field($model, 'name')->textInput([
                            'autofocus' => true,
                            'id' => 'name',
                            'placeholder' => 'Exemplo'
                        ]) 
                        ->label('Nome')?>
                    </div>
                    <div class=" input-field col m6 s12">
                        <?= $form->field($model, 'email')->textInput([
                            'id' => 'email',
                            'placeholder' => 'exemplo@hotmail.com'
                        ]) ?>
                    </div>      
                </div>
                <div class="row">  
                    <div class=" input-field col m6 s12">
                        <?= $form->field($model, 'subject')->textInput([
                            'id' => 'subject',
                            'placeholder' => 'Exemplo'
                        ]) 
                        ->label('Assunto')?>
                    </div>
                    <div class="input-field col m6 s12">
                        <?= $form->field($model, 'body')->textArea([
                            'id' => 'body',
                            'placeholder' => 'Exemplo',
                            'class' => 'materialize-textarea'
                        ]) 
                        ->label('Descrição')?>
                </div>
                <div class="row">
                    <div class="input-field col m12 s12">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 
                            'id' => 'verifycode'         
                        ])
                        ->label('Código de verificação') ?>
                    </div>
                </div>
                <div class="row">   
                    <div class="input-field col m4 s12"></div>
                    <div class="input-field col m4 s12 centerize">
                        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                    <div class="input-field col m4 s12"></div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
