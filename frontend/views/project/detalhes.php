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
</style>
<div class="project-detalhes">
    <div class="container">  
        <div class="row">
            <div class="col m6 s12">
                <?php
                    $avaliacao = $projeto->avaliacao;
                    $contador = $projeto->contador;
                    $name = $projeto->name;
                    $price = $projeto->price;
                    $description = $projeto->description;
                    $date = $projeto->date;  
                    ?>
                    <div style="margin-top:-65px;" class="carousel">
                        <?php
                        foreach($projeto->images as $imagem)
                        {
                            ?>
                            <a class="carousel-item"><img style="margin-left:-50px;width:275px;" src="http://backend.test/<?php echo $imagem->name?>"></a>
                            <?php
                        }  ?>
                    </div>
                    <?php
                ?>
            </div>
            <div class="col m6 s12">
                <label for="username" style="font-size:13.5px;color:rgb(30, 56, 71);">Nome</label>
                <input disabled value="<?php echo $name?>" type="text" class="info" >
                <label for="nome" style="font-size:13.5px;color:rgb(30, 56, 71);">Descrição</label>
                <input disabled value="<?php echo $description ?>" class=" info"> 
            </div>
            <div class="col m6 s12">      
            </div>
            <div class="col m3 s12">
                <label for="email" style="font-size:13.5px;color:rgb(30, 56, 71);">Preço</label>
                <input disabled value="<?php echo $price . ' €'?>" type="text" class="info">
            </div>
            <div class="col m3 s12">
                <label for="username" style="font-size:13.5px;color:rgb(30, 56, 71);">Data</label>
                <input disabled value="<?php echo $date?>" type="text" class="info">
            </div>
            <div class="col m3 s12"> 
                <p style="font-size:16px;font-weight:600">Média das avaliações: <h5> <?php if($projeto['avaliacao'] != 0) { echo $projeto['avaliacao']; } else { echo '0';}?> </h5></p>
            </div>
            <div class="col m3 s12"> 
                <p style="font-size:16px;font-weight:600">Total de avaliações: <h5> <?php if($projeto['contador'] != 0) { echo $projeto['contador']; } else { echo '0';}?> </h5></p>
            </div>
            <div style="margin-top:20px;" class="col m3 s12">  
                <a href="#">
                    <i style="color:rgb(30, 56, 71);"  class="material-icons">star</i>
                </a>
                <a href="#">
                    <i style="color:rgb(30, 56, 71);" class="material-icons">star</i>
                </a>
                <a href="#">
                    <i style="color:rgb(30, 56, 71);" class="material-icons">star</i>
                </a>
                <a href="#">
                    <i style="color:rgb(30, 56, 71);" class="material-icons">star</i>
                </a>
                <a href="#">
                    <i style="color:rgb(30, 56, 71);" class="material-icons">star</i>
                </a>        
            </div>
            <div style="margin-top:20px;" class="col m3 s12">  
            <?php if (!Yii::$app->user->isGuest) 
            {
                ?>
                    <a style="background-color:rgb(30, 56, 71);" class="btn"><i class="material-icons right">add_circle</i>Novo pedido</a>
                <?php
            }
            else
            {
                ?>
                    <a onclick="myFunction()" style="background-color:rgb(30, 56, 71);" class="btn"><i class="material-icons right">add_circle</i>Novo pedido</a>
                <?php
            }
            ?>       
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12">
                <ul class="collection with-header">
                    <li class="collection-header"><h5 style="font-size:22px;font-weight:bold;">Designers</h5></li>
                    <?php foreach($projeto->designers as $designer)
                    {
                        ?>
                        <li class="collection-item"><div><?php echo $designer->name?><a class="secondary-content"><i style="color:rgb(30, 56, 71);" class="material-icons">person</i></a></div></li>
                        <?php
                    }?>
                </ul>
            </div>
            <div class="col m6 s12">
                <ul class="collection with-header">
                    <li class="collection-header"><h5 style="font-size:22px;font-weight:bold;">Categorias</h5></li>
                    <?php foreach($projeto->categorys as $category)
                    {
                        ?>
                        <li class="collection-item"><div><?php echo $category->name?><a class="secondary-content"><i style="color:rgb(30, 56, 71);" class="material-icons">house</i></a></div></li>
                        <?php
                    }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.carousel').carousel();
    })    
    function myFunction() {
            M.toast({html: 'Inicie sessão para poder criar um pedido.'});
    }
</script>   