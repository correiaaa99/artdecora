<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use developit\captcha\Captcha;

$this->title = 'Registar';
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
        margin-top:-20px;
    }
    .field-icon {
        float: right;
    }
    #user-verifycode:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #username:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    #email:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    #password:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    #confirmarpassword:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    .captcha {
        margin-top:-20px;
    }
</style>
<body>
    <div class="container">
        <img style="margin-left:42%;height:15%;width:15%" src="/imagens/site/person.png">
        <div class="row">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'col s12']); ?>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <?= $form->field($model, 'username')->textInput([
                            'id' => 'username',
                            'placeholder' => 'Exemplo'
                        ])
                        ->label(true)?>
                    </div>
                    <div class="input-field col s12 m6">
                        <?= $form->field($model, 'email')->textInput([
                            'id' => 'email',
                            'placeholder' => 'exemplo@hotmail.com'
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m6">
                        <?= $form->field($model, 'password')->passwordInput([
                            'id' => 'password',
                            'placeholder' => '********'
                        ])
                        ->label('Palavra-passe')?>
                        <p style="font-size:12.3px;font-weight:500;">Mínimo = 6 carateres | 1 dígito | 1 caráter maiúsculo e 1 minúsculo</p>
                    </div>
                    <div class="input-field col s12 m6">
                        <?= $form->field($model, 'confirmarpassword')->passwordInput([
                            'id' => 'confirmarpassword',
                            'placeholder' => '********'
                        ])
                        ->label('Confirmar palavra-passe')?>
                    </div>
                </div>
                <div class="row">
                    <div class="col m3 s12"></div>
                    <div class="input-field col m6 s12 captcha">
                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [          
                        ])
                        ->label('Código de verificação') ?>
                    </div>
                    <div class="col m3 s12"></div> 
                </div>
                <div class="row">
                    <div class="input-field col s12 centerize">
                        <?= Html::submitButton('Registar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</body>