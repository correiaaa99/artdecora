<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
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
    #name:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #surname:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #telephone:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #address_name:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #city:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #zip_code:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #address_nameInserir:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #cityInserir:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #zip_codeInserir:focus {
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
    .btn {
        background-color:#5e482b; 

    }
    .btn:hover {
        background-color:#715633
    }
    #birth_date:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
</style>
<div class="user-update">
    <div class="container">  
        <div class="row">
            <h5 style="font-weight:bold;font-size:23px;">Editar perfil</h5>
            <p>
            <hr>
            <?php $form = ActiveForm::begin(['action' => ['/user/update'],'options' => ['method' => 'post', 'enctype' => 'multipart/form-data']]); ?>
                <div class="row">
                    <div class="col m3 s12">
                        <h5 style="font-weight:bold;font-size:23px;">Endereços</h5>
                    </div>
                    <div class="col m3 s12">
                        <a data-target="modal3" href="#modal3" style="background-color:rgb(30, 56, 71);margin-top:20px;" class="modal-trigger btn-small btnInserir"><i class="material-icons right">add</i>Novo endereço</a>
                    </div>
                    <div class="col m6 s12">
                        <h5 style="font-weight:bold;font-size:23px;">Dados pessoais</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12">
                        <table class="striped" id="myTable"  style="margin-top:15px;">
                            <thead>
                                <tr>
                                    <th>Endereço</th>
                                    <th>Cidade</th>
                                    <th>Código Postal</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($addresses as $address) : ?>
                                    <tr>
                                        <td><?php echo $address['address_name']?></td>
                                        <td><?php echo $address['city']?></td>
                                        <td><?php echo $address['zip_code']?></td>
                                        <td><a data-id="<?php echo $address['idAddress']?>" data-zip="<?php echo $address['zip_code']?>" data-city="<?php echo $address['city']?>" data-name="<?php echo $address['address_name']?>"  data-target="modal1" class="modal-trigger icon-block botao" href="#modal1"><i style="color:rgb(30, 56, 71);" class="material-icons">edit</i></a><a  data-target="modal2" class="modal-trigger icon-block btnEliminar" href="#modal2" data-id="<?php echo $address['idAddress']?>"><i style="color:rgb(30, 56, 71);"  class="material-icons">delete</i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col m3 s12">
                        <?= $form->field($model, 'username')->textInput([
                            'id' => 'username',
                            'disabled' => true,
                        ])
                        ->label('Username')?>
                    </div>
                    <div class="col m3 s12">
                        <?= $form->field($model, 'email')->textInput([
                            'id' => 'email',
                            'disabled' => true,
                        ])->label('Email')?>
                    </div>
                    <div class="col m6 s12">
                    </div>
                    <div class="col m3 s12">
                        <?= $form->field($model, 'name')->textInput([
                                'id' => 'name',
                            ])
                            ->label('Nome')?>
                    </div>
                    <div class="col m3 s12">
                        <?= $form->field($model, 'surname')->textInput([
                                'id' => 'surname',
                            ])
                            ->label('Apelido')?>
                    </div>
                    <div class="col m6 s12">
                    </div>
                    <div class="col m3 s12">
                        <?=$form->field($model, 'birth_date')->textInput([
                            'id' => 'birth_date',
                            'type' => 'date',
                        ])->label('Data de nascimento')?>
                    </div>
                    <div class="col m3 s12">
                        <?=$form->field($model, 'telephone')->textInput([
                            'id' => 'telephone',
                            'class' => 'telephone',
                        ])->label('Telemóvel')?>
                    </div>
                    <div class="col m6 s12">
                    </div>
                    <div class="col m6 s12">
                        <label>Foto</label>
                        <p>
                        <?=$form->field($model, 'file')->fileInput([
                            'id' => 'file',
                            'class' => 'file',
                        ])->label(false)?>
                    </div>
                    <div class="col m6 s12">
                    </div>
                    <div class="col m3 s12"> 
                        <?= $form->field($model, 'password')->passwordInput([
                            'id' => 'password',
                        ])
                        ->label('Palavra-passe')?>
                        <p style="font-size:12.3px;font-weight:500;">Mínimo = 6 carateres | 1 dígito | 1 caráter maiúsculo e 1 minúsculo</p>
                    </div>
                    <div class="col m3 s12">
                        <?= $form->field($model, 'confirmarpassword')->passwordInput([
                            'id' => 'confirmarpassword',
                        ])
                        ->label('Confirmar palavra-passe')?>
                    </div>
                    <div style="text-align:center;">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div> 
    <?php $form = ActiveForm::begin(); ?>
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h5 style="font-weight:bold">Atualizar endereço</h5>
                <?php 
                    echo $form->field($endereco, 'idAddress')
                    ->hiddenInput([
                        'id' => 'idAddress'
                    ])
                    ->label(false);
                ?>
                <?= $form->field($endereco, 'address_name')->textInput([
                    'id' => 'address_name',
                ])
                ->label('Endereço')?>
                <?= $form->field($endereco, 'city')->textInput([
                    'id' => 'city',
                ])
                ->label('Cidade')?>
                <?= $form->field($endereco, 'zip_code')->textInput([
                    'id' => 'zip_code',
                    'class' => 'zip_code',

                ])
                ->label('Código Postal')?>
            </div>
            <div class="modal-footer">          
                <div style="text-align:center;">
                    <?= Html::button('Guardar', [
                        'class' => 'btn btn-primary',
                        'onclick' =>'
                            $.ajax({
                                type: "post",
                                url: "' . Url::to(['address/update']) . '?id="+$("#idAddress").val(),
                                data:  {address: $("#address_name").val(), city: $("#city").val(), zip: $("#zip_code").val()},
                                success: function (res) {
                                    if(res == "alterado")
                                    {
                                        M.toast({html: "Endereço alterado com sucesso."});
                                        setTimeout(
                                            function() 
                                            {
                                                location.reload();
                                            }, 1000);
                                    }
                                }
                            });
                        ',
                    ]) ?>
                </div>
            </div>
        </div>    
    <?php ActiveForm::end(); ?>   
    <?php $form = ActiveForm::begin(['action' => ['/address/create'],'options' => ['method' => 'post']]); ?>
        <div id="modal3" class="modal">
            <div class="modal-content">
                <h5 style="font-weight:bold">Novo endereço</h5>
                <?= $form->field($endereco, 'address_name')->textInput([
                    'id' => 'address_nameInserir',
                ])
                ->label('Endereço')?>
                <?= $form->field($endereco, 'city')->textInput([
                    'id' => 'cityInserir',
                ])
                ->label('Cidade')?>
                <?= $form->field($endereco, 'zip_code')->textInput([
                    'id' => 'zip_codeInserir',
                    'class' => 'zip_code'

                ])
                ->label('Código Postal')?>
            </div>
            <div class="modal-footer">          
                <div style="text-align:center;">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>    
    <?php ActiveForm::end(); ?>  
    <div id="modal2" class="modal">
        <div class="modal-content">
            <h5 style="font-weight:bold">Eliminar endereço</h5>
            <p style="font-size:20px;margin-top:50px;text-align:center">Tem a certeza que deseja eliminar este endereço?</p>
            <input type="text" id="idEliminar" hidden>
        </div> 
        <div class="modal-footer">
            <div style="text-align:center">
                <?= Html::button('Eliminar', [
                        'class' => 'btn btn-primary',
                        'onclick' =>'
                            $.ajax({
                                type: "post",
                                url: "' . Url::to(['address/delete']) . '?id="+$("#idEliminar").val() ,
                                data:  {},
                                success: function (res) {
                                    if(res == "eliminado")
                                    {
                                        M.toast({html: "Endereço eliminado com sucesso."});
                                        setTimeout(
                                            function() 
                                            {
                                                location.reload();
                                            }, 1000);
                                    }
                                    else
                                    {
                                        M.toast({html: "Não é possível eliminar este endereço. Está associado a um ou mais pedidos."});
                                        setTimeout(
                                            function() 
                                            {
                                                location.reload();
                                            }, 1500);
                                    }
                                }
                            });
                        ',
                ]) ?>
            </div>
        </div>    
    </div>
<?php 
if (Yii::$app->session->hasFlash('enderecoInserido'))
{ 
    ?>
    <script>
            M.toast({html: 'Endereço inserido com sucesso.'});
    </script>
    <?php
}
if (Yii::$app->session->hasFlash('enderecoigual'))
{ 
    ?>
    <script>
            M.toast({html: 'Endereço já existe.'});
    </script>
    <?php
}
if (Yii::$app->session->hasFlash('endereconull'))
{ 
    ?>
    <script>
            M.toast({html: 'Crie um novo endereço para criar um pedido.'});
    </script>
    <?php
}?>
<script>
    $(document).ready(function(){
        $('.modal').modal();
    });
</script>
<script>
    $('.botao').on("click",function(){
        var endereco =  $(this).attr('data-name');
        $('#address_name').val(endereco);
        var city =  $(this).attr('data-city');
        $('#city').val(city);
        var zip_code =  $(this).attr('data-zip');
        $('#zip_code').val(zip_code);
        var id =  $(this).attr('data-id');
        $('#idAddress').val(id);
    });
</script>
<script>
    $(document).ready(function($){
        $('.zip_code').mask('0000-000');
    });
    $(document).ready(function($){
        $('.telephone').mask("999-999-999");
    });
    $('.btnEliminar').on("click",function(){
        var id =  $(this).attr('data-id');
        $('#idEliminar').val(id);
    });
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
</script>
