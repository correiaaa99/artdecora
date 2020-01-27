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
use frontend\models\Project;
use yii\helpers\ArrayHelper;
use kartik\rating\StarRating;
use yii\web\JsExpression;
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
    #editar {
        background-color: rgb(30, 56, 71);
    }
    .btn:hover {
        color:white;
    }
</style>
<div class="project-detalhes">
    <div class="container">  
        <div class="row">
            <div class="col m6 s12">
                <?php
                    $estado = $request->estado;
                    $endereco = $request->endereco;
                    $descricao = $request->descricao;
                    $projeto = $request->name;
                    ?>
                    <div style="margin-top:-82px;" class="carousel">
                        <?php
                        foreach($request->images as $imagem)
                        {
                            ?>
                            <a class="carousel-item"><img style="margin-left:-50px;width:250px;height:200px" src="http://backend.test/<?php echo $imagem->name?>"></a>
                            <?php
                        }  ?>
                    </div>
                    <?php
                ?>
            </div>
            <div class="col m6 s12">
                <label for="descricao" style="font-size:13.5px;color:rgb(30, 56, 71);">Descrição</label>
                <input disabled value="<?php echo $descricao ?>" class=" info"> 
                <label for="endereco" style="font-size:13.5px;color:rgb(30, 56, 71);">Endereço</label>
                <input disabled value="<?php echo $endereco ?>" class=" info"> 
            </div>
            <div class="col m6 s12">      
            </div>
            <div class="col m6 s12">
                <label for="estado" style="font-size:13.5px;color:rgb(30, 56, 71);">Estado</label>
                <input disabled value="<?php 
                if($estado == 'a')
                {
                    echo 'Pendente';
                }
                else if($estado == 'b')
                {
                    echo 'Em processamento';
                }
                else
                {
                    echo 'Finalizado';
                }
                ?>" type="text" class="info">
            </div>        
        </div>
    </div>
<script>
    $(document).ready(function(){
        $('.carousel').carousel();
    })   
</script>   