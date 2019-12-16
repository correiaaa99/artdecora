<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .btn-floating.halfway-fab {
        background-color: rgb(30, 56, 71);
    }
</style>
<?php
use frontend\models\Project;
/* @var $this yii\web\View */
$this->title = 'Página inicial';
?>
<div class="site-index" >
    <div class="jumbotron">
        <img id="imagem" src="/imagens/site/imagem3.png" style="width:100%;height:541px;">
    </div>
    <h3 style="font-size:33px;font-weight:900;font-family:;text-align:center;color:rgb(30, 56, 71);">Os nossos projetos</h3>
    <div class="body-content">
        <div class="row">
            <div class="col m12 s12">
                <div class="projeto">
                    <div class="row">   
                    <?php $dataProjects = Project::find()
                        ->select(['tbl_project.idProject', 'tbl_project.name as ProjectName', 'tbl_project.description', 'tbl_image.name as image'])
                        ->from(['tbl_project'])
                        ->leftJoin('tbl_image', 'tbl_image.idProject = tbl_project.idProject')
                        ->asArray()
                        ->all();?>
                        <?php foreach($dataProjects as $project)
                        {
                        ?>
                        <div class="col s12 m4">
                            <div class="card">
                                <div class="card-image">
                                <img src="http://backend.test/<?php echo $project['image'];?>">  
                                <span class="card-title"><?php echo $project['ProjectName']?></span>
                                <a class="btn-floating halfway-fab waves-effect waves-light"><i class="material-icons">add</i></a>
                                </div>
                                <div class="card-content">
                                <p><?php echo $project['description']?></p>
                                </div>
                            </div>
                        </div>                    
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    if (Yii::$app->session->hasFlash('success'))
    { 
        ?>
        <script>
                M.toast({html: 'Registado com sucesso.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('email'))
    { 
        ?>
        <script>
                M.toast({html: 'Verifique o seu email para obter mais instruções.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('error'))
    { 
        ?>
        <script>
                M.toast({html: 'Desculpe, não foi possível alterar a palavra-passe para o email fornecido.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('contato'))
    { 
        ?>
        <script>
                M.toast({html: 'Email enviado com sucesso. Aguarde pela resposta.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('errorcontato'))
    { 
        ?>
        <script>
                M.toast({html: 'Desculpe, não foi possível enviar o email.'});
        </script>
        <?php
    }
    
    ?>
</div>
