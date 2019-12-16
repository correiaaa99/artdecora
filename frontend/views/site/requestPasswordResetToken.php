<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
        background-color:#715633
    }
    .centerize {
        text-align:center;
        margin-top:-15px;
        height:60px;
    }
    #email:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    }
</style>
<div class="site-request-password-reset">
    <div class="container">
        <img style="margin-left:42%;height:12%;width:12%" src="/imagens/site/message.png">
        <p style="text-align:center">Por favor, preencha o seu email. Será enviado um link para alterar a palavra-passe.</p>
        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form', 'class' => 'col s12']); ?>
                <div class="row">
                    <div class="col m3 s12"></div>
                    <div class="col m6 s12">
                        <?= $form->field($model, 'email')->textInput([
                            'autofocus' => true,
                            'id' => 'email',
                            'placeholder' => 'exemplo@hotmail.com'
                        ]) ?>
                    </div>
                    <div class="col m3 s12"></div> 
                </div> 
                <div class="row">
                    <div class="input-field col s12 centerize">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
