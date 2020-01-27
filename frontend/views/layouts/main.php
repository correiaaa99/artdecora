
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>ArtDecora</title>
    <?php $this->head() ?>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .navbar-material .nav-wrapper .brand-logo img {
            height: 82px;
        }
        nav.navbar-material {
            background: rgb(30, 56, 71);
            border: none;
            box-shadow: none;
            height:85px;    
        }
        .navbar-material .nav-wrapper > ul > li > a {
            color: rgb(235, 217, 142);
            font-size:17px;
            margin-top:9px;
            font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;
        }
        @media (max-width: 600px) {
        .navbar-material .nav-wrapper .brand-logo img {
            height: 80px;
        }
    }
    </style>
</head>
<body style="background-color:rgba(30, 56, 71, 0.1)">
<?php $this->beginBody() ?>
<nav class="navbar-material">
    <div class="nav-wrapper">   
        <a href="<?= Yii::$app->homeUrl?>" class="brand-logo"><img src="/imagens/site/logotipo.png"></a>
        <a href="#" style="margin-top:12px;" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php if (Yii::$app->user->isGuest) {
                ?> 
                    <li><a href="<?= Url::to('/site/contact')?>">Contatos</a></li>
                    <li><a href="<?= Url::to('/site/signup')?>">Registo</a></li>
                    <li><a href="<?= Url::to('/site/login')?>">Entrar</a></li>
                <?php 
            }
            else
            {
                ?>
                    <li><a href="<?= Url::to('/site/contact')?>">Contatos</a></li>
                    <li ><a class='dropdown-trigger ' href='#' data-target='dropdown1' ><i class="fa fa-user"></i> <?= Yii::$app->user->identity->username ?></a></li>
                <?php 
            }
            ?>

        </ul>      
    </div>
</nav> 

<ul class="sidenav" id="mobile-demo">
    <?php 
    if (Yii::$app->user->isGuest) 
    {
        ?>
            <li><a href="<?= Yii::$app->homeUrl?>">Início</a></li>
            <li><a href="#">Pesquisa avançada</a></li>
            <li><a href="<?= Url::to('/site/contact')?>">Contatos</a></li>
            <li><a href="<?= Url::to('/site/signup')?>">Registo</a></li>
            <li><a href="<?= Url::to('/site/login')?>">Entrar</a></li>
        <?php 
    }
    else
    {
        ?>
            <li><a href="#">Pesquisa avançada</a></li>
            <li><a href="<?= Url::to('/site/contact')?>">Contactos</a></li>
            <li><a  class='dropdown-trigger ' href='#' data-target='dropdown2' data-constrainWidth="false" ><i class="fa fa-user"></i><?= Yii::$app->user->identity->username ?></a></li>
        <?php 
    }
    ?>
</ul>
<?php if(!Yii::$app->user->isGuest): ?>
<!-- Dropdown Structure -->
<ul id='dropdown1' style="min-width: 200px !important;" class='dropdown-content'>
    <li><a style="color: rgb(30, 56, 71); font-weight:bold;" href="/user/perfil"><i style="color: rgb(30, 56, 71)" class="material-icons">account_circle</i>Meu perfil</a></li>
    <li><a style="color: rgb(30, 56, 71);" href="/user/update"><i style="color: rgb(30, 56, 71)" class="material-icons">edit</i>Editar perfil</a></li>
    <li><a style="color: rgb(30, 56, 71);" href="/user/perfil"><i style="color: rgb(30, 56, 71)" class="material-icons">book</i>Livros de ideias</a></li>
    <li><a style="color: rgb(30, 56, 71);" href="/request/index"><i style="color: rgb(30, 56, 71)" class="material-icons">perm_contact_calendar</i>Pedidos</a></li>
    <li><a style="color: rgb(30, 56, 71)" href="/site/logout"><i style="color: rgb(30, 56, 71)" class="material-icons">input</i>Terminar sessão</a></li>
</ul>
<!-- Dropdown Structure -->
<ul id='dropdown2' style="min-width: 200px !important;"  class='dropdown-content'>
    <li><a style="color: rgb(30, 56, 71); font-weight:bold;" href="/user/perfil"><i style="color: rgb(30, 56, 71)" class="material-icons">account_circle</i>Meu perfil</a></li>
    <li><a style="color: rgb(30, 56, 71);" href="/user/update"><i style="color: rgb(30, 56, 71)" class="material-icons">edit</i>Editar perfil</a></li>
    <li><a style="color: rgb(30, 56, 71);" href="/user/perfil"><i style="color: rgb(30, 56, 71)" class="material-icons">book</i>Livros de ideias</a></li>
    <li><a style="color: rgb(30, 56, 71);" href="/request/index"><i style="color: rgb(30, 56, 71)" class="material-icons">perm_contact_calendar</i>Pedidos</a></li>
    <li><a style="color: rgb(30, 56, 71)" href="/site/logout"><i style="color: rgb(30, 56, 71)" class="material-icons">input</i>Terminar sessão</a></li>
</ul> 
<?php endif; ?>
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
    $(".dropdown-trigger").dropdown({
   coverTrigger: false
});
</script>