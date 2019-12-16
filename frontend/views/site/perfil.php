
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
?>


<style> 
    md-icon{
  font-family: 'Material Icons' !important;
}
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
    .material-icons {
        background-color:rgb(30, 56, 71);
    }
    .info {
        font-weight:bold;
        font-size:18px;
        font-family:Century Gothic;
    }
</style>
<div class="user-perfil">
    <div class="container">  
        <div class="row">
            <div class="col m6 s12">
                <img style="width:65%;height:65%;border-radius: 10px;" class="responsive-img" src="http://backend.test/<?php echo $user->photo;?>">
                <a style="width:40px;height:40px;margin-left:-25px;" class="editar btn-floating btn-large waves-effect waves-light "><i style="margin-top:-10px;" class="material-icons">edit</i></a>
            </div>
            <div class="col m3 s12">
                <label for="username" style="font-size:13.5px;color:rgb(30, 56, 71);">Username</label>
                <input disabled value="<?php echo $user->username?>" type="text" class="info" >
                <label for="email" style="font-size:13.5px;color:rgb(30, 56, 71);">Email</label>
                <input disabled value="<?php echo $user->email?>" type="text" class="info">
                <label for="nome" style="font-size:13.5px;color:rgb(30, 56, 71);">Nome</label>
                <input disabled value="<?php echo $user->name . ' ' . $user->surname?>" type="text" class="info">
            </div>
            <div class="col m3 s12">
                <label for="username" style="font-size:13.5px;color:rgb(30, 56, 71);">Data de nascimento</label>
                <input disabled value="<?php echo $user->birth_date?>" type="text" class="info">
                <label for="email" style="font-size:13.5px;color:rgb(30, 56, 71);">Telemóvel</label>
                <input disabled value="<?php echo $user->telephone?>" type="text" class="info">
            </div>
        </div>
    </div>
</div>
