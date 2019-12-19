
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
use frontend\models\IdeaBook;
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
<div class="user-perfil">
    <div class="container">  
        <div class="row">
            <div class="col m6 s12">
                <?php
                    $username = $user->username;
                    $photo = $user->photo;
                    $email = $user->email;
                    $surname = $user->surname;
                    $name = $user->name;
                    $data = $user->birth_date;
                    $telephone = $user->telephone;
                    if($photo)
                    {
                        ?>
                        <img style="width:250px;height:200px;border-radius: 10px;"  class="materialboxed" src="http://backend.test/<?php echo $photo?>">
                        <?php
                    }
                    else
                    {
                        ?>
                        <img style="width:250px;height:200px;border-radius: 10px;"  class="materialboxed" src="http://backend.test/img/nouser.jpg">
                        <?php
                    }
                ?>
                <a  style="width:40px;height:40px;margin-left:228px;margin-top:-40px; " class="btn-floating btn-large waves-effect waves-light"><i id="editar" style="margin-top:-10px;" class="material-icons">edit</i></a>
            </div>
            <div class="col m3 s12">
                <label for="username" style="font-size:13.5px;color:rgb(30, 56, 71);">Username</label>
                <input disabled value="<?php echo $username?>" type="text" class="info" >
            </div>
            <div class="col m3 s12">
                <label for="nome" style="font-size:13.5px;color:rgb(30, 56, 71);">Nome</label>
                <input disabled value="<?php echo $name . ' ' . $surname?>" type="text" class="info">
            </div>
            <div class="col m6 s12"></div>
            <div class="col m6 s12">
                <label for="email" style="font-size:13.5px;color:rgb(30, 56, 71);">Email</label>
                <input disabled value="<?php echo $email?>" type="text" class="info">
            </div>
            <div class="col m6 s12"></div>
            <div class="col m3 s12">
                <label for="username" style="font-size:13.5px;color:rgb(30, 56, 71);">Data de nascimento</label>
                <input disabled value="<?php echo $data?>" type="text" class="info">
            </div>
            <div class="col m3 s12">
                <label for="telephone" style="font-size:13.5px;color:rgb(30, 56, 71);">Telemóvel</label>
                <input disabled value="<?php echo $telephone?>" type="text" class="info">
            </div>   
        </div>
        <div style="margin-top:25px;">
            <p style="text-align:center;font-weight:bold;font-size:22px"><?php echo count($books) ?></p>
            <p style="text-align:center;font-weight:bold;font-size:19px;margin-top:-15px;">Livros de ideias</p>
            <hr style="width:65%;border-top: 1px solid rgb(30, 56, 71);">
            <div style="margin-top:15px;" class="row">
                <div class="col m4"></div>
                <div class="col m4">
                    <a style="border-radius:7px;background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn"><i class="material-icons right">add</i>Criar um novo livro de ideias</a>
                </div>
                <div class="col m4"></div>
            </div>
            <?php foreach($books as $book)
            {
            ?> 
                <div class="row">     
                    <div class="col s6 m4">
                    <div class="card" id="<?php echo $book['projeto']?>">
                        <div style="height:200px" class="card-image waves-effect waves-block waves-light">
                            <img src="http://backend.test/<?php echo $book['imagem']?>" >
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4"><?php echo $book['title'];?><i class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><?php echo $book['title'];?><i class="material-icons right">close</i></span>
                            <p><?php echo $book['description'];?></p>
                        </div>
                    </div>
                </div>  
                <?php
            }
            ?>
        </div>    
    </div>
</div>
<script>
    $(document).ready(function(){
    $('.materialboxed').materialbox();
  });

</script>