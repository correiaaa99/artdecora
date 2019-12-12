
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
<body>
<?php $this->beginBody() ?>
<nav class="navbar-material">
    <div class="nav-wrapper">   
        <a href="<?= Yii::$app->homeUrl?>" class="brand-logo"><img src="/imagens/logotipo.png"></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            
            <?php if (!Yii::$app->user->isGuest) {
                ?>
                    <li><a href="#">Pesquisa avançada</a></li>
                    <li><a href="#">Contactos</a></li>
                    <li><a href="badges.html">Registo</a></li>
                    <li><a href="collapsible.html">Login</a></li>
                <?php 
            }
            else
            {
                ?>
                    <li><a href="#">Pesquisa avançada</a></li>
                    <li><a href="#">Contactos</a></li>
                    <li><a href="collapsible.html">Pedidos</a></li>
                    <li><a href="collapsible.html">Livros de ideias</a></li>
                    <li><a class="modal-trigger" href="#modal1"><i class="fa fa-user"></i> Perfil</a></li>
                <?php 
            }
            ?>

        </ul>      
    </div>
</nav> 
<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Perfil</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a style="float:left" href="#!" class="modal-close waves-effect waves-green btn-flat">Editar perfil</a>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Sair</a>
    </div>
</div> 
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    (function ($) {
    $(function () {
        $('.modal').modal();
    });
})(jQuery);
</script>