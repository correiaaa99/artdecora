<!-- Compiled and minified CSS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    .btn-floating.halfway-fab {
        background-color: rgb(30, 56, 71);
    }
    .pagination {
        text-align: center;
    }
    .pagination li.active a {
        color: #fff;
        background-color: rgb(30, 56, 71);
    }
    .pagination li a {
        color: #444;
        display: inline-block;
        font-size: 1.2rem;
        padding: 0 10px;
        line-height: 30px;
    }
    .button {
        
        color: white;
        font-size: 16px;
        padding: 16px 32px;
    }
    .guardar {
        position: relative;
        width: 100%;
    }

    .image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }

    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }

    .guardar:hover .image {
        opacity: 0.6;
    }

    .guardar:hover .middle {
        opacity: 1;
    }
    #titulo:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    #comentario:focus {
     border-bottom: 1px solid #BD9056;
     box-shadow: 0 1px 0 0 #BD9056;
    }
    .btn {
        background-color:#5e482b; 

    }
    .btn:hover {
        background-color:#715633
    }
    .dropdown-content li>span {
        color: rgb(30, 56, 71);
    }
</style>
<?php
use frontend\models\Project;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
$this->title = 'Página inicial';
?>
<div class="site-index" >
    <div class="jumbotron">
        <img id="imagem" src="/imagens/site/imagem3.png" style="width:100%;height:541px;">
    </div>
    <h3 style="font-size:33px;font-weight:900;font-family:;text-align:center;color:rgb(30, 56, 71);">Os nossos projetos</h3>
    <div class="body-content">
    <?php Pjax::begin() ?>
        <div class="row">
            <div class="col m12 s12">
                <div class="projeto">
                    <div class="row">
                        <?php 
                        foreach($dataProjects as $project)
                        {
                        ?>
                        <div class="col s6 m3">
                            <div class="card">
                                <div class="card-image">
                                    <div class="guardar">
                                        <img class="image" style="height:210px;" src="http://backend.test/<?php echo $project['image'];?>">
                                        <div class="button">
                                            <?php if (!Yii::$app->user->isGuest) 
                                            {
                                                ?>
                                                <div class="middle"><a id="<?php echo $project['idProject']?>" style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn modal-trigger botao " href="#modal1"><i class="material-icons right">add</i>Guardar</a></div>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="middle"><a onclick="myFunction()"  style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn"><i class="material-icons right">add</i>Guardar</a></div>
                                                <?php
                                            }
                                            ?>      
                                        </div>        
                                    </div>  
                                </div>
                                <div style="height:170px;margin-top:-40px" class="card-content">
                                    <p style="font-weight:bold;font-size:20px;"><?php echo $project['ProjectName']?></p>
                                    <p><?php echo $project['description']?></p>
                                </div>
                                <div class="card-action">
                                    <a style="color:rgb(30, 56, 71);" href="/project/detalhes?id=<?php echo $project['idProject']?>">Detalhes</a>
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
        <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>
    </div>
    <?php Pjax::end() ?>
    <?php $form = ActiveForm::begin(['action' => ['/project-idea-book/create'],'options' => ['method' => 'post']]); ?>
        <div id="modal1" style="height:400px;" class="modal">
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s12">
                        <h5 style="margin-top:-20px">Guardar o projeto </h5>
                        <?php $dataBooks = ArrayHelper::map(\frontend\models\IdeaBook::find()
                        ->where(['idUser' => Yii::$app->user->id])
                        ->orderBy('idBook asc')
                        ->all(), 'idBook', 'title');?>
                        <?= $form->field($livro, 'idBook')
                        ->label('Livro de ideias')
                        ->dropDownList($dataBooks, ['prompt' => 'Selecione um livro de ideias']);?>
                    </div>
                </div>                               
                <?php 
                    echo $form->field($livro, 'idProject')
                    ->hiddenInput([
                        'id' => 'projeto'
                    ])
                    ->label(false);
                ?>
                <div class="row">
                    <div class="input-field col s12 m4">    
                        <?= $form->field($livro, 'title')->textInput([
                            'id' => 'titulo',
                        ])
                        ->label('Título')?>
                    </div>
                    <div class="input-field col s12 m8">    
                        <?= $form->field($livro, 'comment')->textArea([
                            'id' => 'comentario',
                            'class' => 'materialize-textarea'
                        ])
                        ->label('Comentário')?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m4"></div>
                    <div class="input-field col m4">  
                        <div style="text-align:center;">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <div class="input-field col m4"></div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>    
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
    if (Yii::$app->session->hasFlash('projetoassociado'))
    { 
        ?>
        <script>
                M.toast({html: 'O projeto selecionado já está associado ao livro selecionado.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('projetoassociadosucesso'))
    { 
        ?>
        <script>
                M.toast({html: 'Projeto adicionado ao livro de ideias com sucesso.'});
        </script>
        <?php
    }
    ?>
    <script>
        $(document).ready(function(){
            $('select').formSelect();
        }); 
         $(document).ready(function(){
            $('.modal').modal();
        });
        $(".botao").click(function(){
            $('#projeto').val(this.id);
            $('#comentario').val('');
            $('#titulo').val(''); 
        });
        function myFunction() {
            M.toast({html: 'Inicie sessão para poder adicionar um projeto a um livro de ideias.'});
        }
    </script>
    
</div>
