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
    .btn {
        background-color:#5e482b; 

    }
    .btn:hover {
        background-color:#715633
    }
    #title:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
</style>
<div class="project-idea-book-projetos">
    <div class="container">  
        <h4 style="text-align:center;font-weight:645;"><?php echo $book->title?></h4>
        <h5 style="text-align:center;font-size:17.2px;"><?php echo $book->date?></h5>
        <div class="row">  
            <?php if($projetos != null)
            {
                foreach($projetos as $projeto) : ?>
                <div class="col s6 m4">
                    <div class="card">
                        <div style="height:200px" class="card-image waves-effect waves-block waves-light">
                            <?php if($projeto['imagem'] != '') :?>
                                <img src="http://backend.test/<?php echo $projeto['imagem'];?>">
                            <?php endif ?>
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4"><?php echo $projeto['title'];?><i class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal">
                            <span style="font-weight:600" class="card-title grey-text text-darken-4"><?php echo $projeto['title'];?><i class="material-icons right">close</i></span>
                            <p><?php echo $projeto['comment'];?></p>
                            <div style="text-align:center">
                                <a style="background-color:rgb(30, 56, 71);" data-id="<?php echo $projeto['id_Project_idea_book']?>" data-title="<?php echo $projeto['title']?>" data-comment="<?php echo $projeto['comment']?>" data-target="modal1" class="modal-trigger icon-block btn botao" href="#modal1"><i class="material-icons">edit</i></a>
                                <a style="background-color:rgb(30, 56, 71);margin-left:10px;" data-target="modal2" class="modal-trigger icon-block btn btnEliminar" href="#modal2" data-id="<?php echo $projeto['id_Project_idea_book']?>"><i class="material-icons">delete</i></a>
                                <p>
                                <a style="background-color:rgb(30, 56, 71);" href="/project/detalhes?id=<?php echo $projeto['idProject']?>" class="btn">Detalhes do projeto</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            <?php
            }
            else
            {
                ?>
                <div style="background-color:rgb(30, 56, 71);height:100px;border-radius:15px;">
                    <h6 style="text-align:center;color:white;padding:40px;font-weight:600;">Não existem projetos neste livro. Volte à <a style="color:rgb(235, 217, 142);" href='<?= Yii::$app->homeUrl ?>'>página inicial</a> para adicionar projetos.</h6>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php $form = ActiveForm::begin(); ?>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5 style="font-weight:bold">Atualizar projeto no livro de ideias</h5>
            <?php 
                echo $form->field($projetoUpdate, 'id_Project_idea_book')
                ->hiddenInput([
                    'id' => 'id_Project_idea_book'
                ])
                ->label(false);
            ?>
            <?= $form->field($projetoUpdate, 'title')->textInput([
                'id' => 'title',
            ])
            ->label('Título')?>
            <label>Comentário</label>
            <p>
            <?= alexantr\ckeditor\CKEditor::widget([
                'id' => 'comment',
                'name' => 'comment',
                'clientOptions' => [
                    'extraPlugins' => 'autogrow,colorbutton,colordialog,iframe,justify,showblocks',
                    'removePlugins' => 'resize',
                    'autoGrow_maxHeight' => 900,
                    'stylesSet' => [
                        ['name' => 'Subscript', 'element' => 'sub'],
                        ['name' => 'Superscript', 'element' => 'sup'],
                    ],
                ],
            ]) ?>
        </div>
        <div class="modal-footer">          
            <div style="text-align:center;">
                <?= Html::button('Guardar', [
                    'class' => 'btn btn-primary',
                    'onclick' =>'
                        $.ajax({
                            type: "post",
                            url: "' . Url::to(['project-idea-book/update']) . '?id="+$("#id_Project_idea_book").val(),
                            data:  {title: $("#title").val(), comment: $("#comment").val()},
                            success: function (res) {
                                if(res == "alterado")
                                {
                                    M.toast({html: "Projeto no livro de ideias alterado com sucesso."});
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
<div id="modal2" class="modal">
    <div class="modal-content">
        <h5 style="font-weight:bold">Eliminar projeto do livro de ideias</h5>
        <p style="font-size:20px;margin-top:50px;text-align:center">Tem a certeza que deseja eliminar este projeto do livro de ideias?</p>
        <input type="text" id="idEliminar" hidden>
    </div> 
    <div class="modal-footer">
        <div style="text-align:center">
            <?= Html::button('Eliminar', [
                    'class' => 'btn btn-primary',
                    'onclick' =>'
                        $.ajax({
                            type: "post",
                            url: "' . Url::to(['project-idea-book/delete']) . '?id="+$("#idEliminar").val() ,
                            data:  {},
                            success: function (res) {
                                if(res == "eliminado")
                                {
                                    M.toast({html: "Projeto eliminado do livro de ideias com sucesso."});
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
<script>
    $('.botao').on("click",function(){
        var titulo =  $(this).attr('data-title');
        $('#title').val(titulo);
        var comment =  $(this).attr('data-comment');
        $('#comment').val(comment);
        var id =  $(this).attr('data-id');
        $('#id_Project_idea_book').val(id);
    });
    $(document).ready(function(){
        $('.modal').modal();
    });
    $('.btnEliminar').on("click",function(){
        var id =  $(this).attr('data-id');
        $('#idEliminar').val(id);
    });
</script>