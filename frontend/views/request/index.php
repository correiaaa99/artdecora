<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
    .info {
        font-weight:bold;
        font-size:18px;
        font-family:Century Gothic;
    }
    .btn {
        background-color:#5e482b; 

    }
    .btn:hover {
        background-color:#715633
    }
</style>
<div class="request-index">
    <div class="container">   
        <h5 style="font-weight:bold;font-size:23px;text-align:center;">Pedidos</h5>
        <div style="text-align:center;">
            <a href="/request/create?projeto=<?php echo null?>" style="background-color:rgb(30, 56, 71);margin-top:20px;" class="btn-small"><i class="material-icons right">add</i>Novo pedido</a>
        </div>  
        <div class="row">
            <div class="col m12 s12">
                <?php if($pedidos != null)
                {
                    ?>
                    <table class="striped responsive-table" id="myTable"  style="margin-top:15px;">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Endereço</th>
                                <th>Estado</th>
                                <th>Detalhes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pedidos as $pedido) : ?>
                                <tr>
                                    <td><?php echo $pedido['descricao']?></td>
                                    <td><?php echo $pedido['address_name']?></td>
                                    <td><?php 
                                            if($pedido['estado'] == 'a')
                                            {
                                                echo '<span style="color:white;font-size:14px;font-weight:550" class="red badge">';
                                                    echo 'Pendente';
                                                echo '</span>';
                                            }
                                            else if($pedido['estado'] == 'b')
                                            {
                                                echo '<span style="color:white;font-size:14px;font-weight:550" class="yellow badge">';
                                                    echo 'Em processamento';
                                                echo '</span>';
                                            }
                                            else 
                                            {
                                                echo '<span style="color:white;font-size:14px;font-weight:550" class="green badge">';
                                                    echo 'Finalizado';
                                                echo '</span>';
                                            }
                                        ?>
                                    </td>
                                    <td><a style="color:rgb(30, 56, 71);" href="/request/view?id=<?php echo $pedido['idRequest']?>" class="icon-block"><i class="material-icons">visibility</i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                }
                else
                {
                    ?>
                        <div style="background-color:rgb(30, 56, 71);height:100px;border-radius:15px;">
                        <h6 style="text-align:center;color:white;padding:40px;font-weight:600;">Não existem pedidos. Poderá realizar um pedido personalido ou fazer um pedido a partir de um projeto. Se desejar realizar um pedido personalidado volte à <a style="color:rgb(235, 217, 142);" href='<?= Yii::$app->homeUrl ?>'>página inicial</a> e consulte os projetos .</h6>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    if (Yii::$app->session->hasFlash('pedidoinserido'))
    { 
        ?>
        <script>
                M.toast({html: 'Pedido criado com sucesso.'});
        </script>
        <?php
    }
?>
