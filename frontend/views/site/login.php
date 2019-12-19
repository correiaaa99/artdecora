<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveField;

$this->title = 'Entrar';
?>
<style> 
    .container {
        background: white;
        padding: 20px 25px;
        border: 5px solid #BD9056;
        width: 45%;
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
        background-color:#715633;
    }
    .centerize {
        text-align:center;
        margin-top:10px;

    }
    .field-icon {
        float: right;
    }
    #email:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    #password:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    [type="checkbox"].filled-in:checked + span:not(.lever):after {
        top: 0;
        width: 20px;
        height: 20px;
        border: 2px solid #BD9056;
        background-color: #BD9056;
        z-index: 0;
    }
</style>
<div class="site-login">
    <div class="container">
        <img style="margin-left:42%;height:12%;width:12%" src="/imagens/site/person.png">
        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'col s12']); ?>
                <div class="row">
                    <div class="col m3 s12"></div>
                    <div class="col m6 s12">
                        <?= $form->field($model, 'email')->textInput([
                            'autofocus' => true,
                            'id' => 'email',
                            'placeholder' => 'exemplo@hotmail.com'
                        ]) 
                        ->label('Email')?>
                    </div>
                    <div class="col m3 s12"></div> 
                </div>
                <div class="row">
                    <div class="col m3 s12"></div>
                    <div class="col m6 s12">
                        <?= $form->field($model, 'password')->passwordInput([
                            'id' => 'password',
                            'placeholder' => '********'
                        ])
                        ->label('Palavra passe') ?>
                    </div>
                    <div class="col m3 s12"></div> 
                </div>
                <div class="row">
                    <div class="input-field col s12 centerize">
                        <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col m2 s12"></div>
                    <div class="col m8">
                        <div style="color:grey;height:53px;">
                            Esqueceu-se da palavra-passe? <?= Html::a('Recuperar aqui', ['site/request-password-reset']) ?>!
                        </div> 
                    </div>
                    <div class="col m2 s12"></div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php 
    if (Yii::$app->session->hasFlash('password'))
    { 
        ?>
        <script>
                M.toast({html: 'Palavra-passe alterada com sucesso.'});
        </script>
        <?php
    }
?>
