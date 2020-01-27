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
use frontend\models\IdeaBook;
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
    #descriptionInserir:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #titleInserir:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #description:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #title:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
</style>
<div class="user-perfil">
    <div class="container">  
        <div class="row">
            <div class="col m2 s12"></div>
            <div class="col m4 s12">
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
                        <img style="width:250px;height:200px;border-radius: 10px;" class="materialboxed" src="http://backend.test/<?php echo $photo?>">
                        <?php
                    }
                    else
                    {
                        ?>
                        <img style="width:250px;height:200px;border-radius: 10px;"  class="materialboxed" src="http://backend.test/img/nouser.jpg">
                        <?php
                    }
                ?>
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
                    <a data-target="modal1" href="#modal1" style="border-radius:7px;background-color:rgb(30, 56, 71);" class="modal-trigger btn btnInserir"><i class="material-icons right">add</i>Criar um novo livro de ideias</a>
                </div>
                <div class="col m4"></div>
            </div>
            <div class="row">  
                <?php foreach($books as $book) : ?>
                    <div class="col s6 m4">
                        <div class="card">
                            <div style="height:200px;" class="card-image waves-effect waves-block waves-light">
                                <?php if($book['imagem'] != '') :?>
                                    <img src="http://backend.test/<?php echo $book['imagem'];?>">
                                <?php endif ?>
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><?php echo $book['title'];?><i class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span style="font-weight:600" class="card-title grey-text text-darken-4"><?php echo $book['title'];?><i class="material-icons right">close</i></span>
                                <p style="font-weight:500"><?php echo $book['date'];?></p>
                                <p><?php echo $book['description'];?></p>
                                <div style="text-align:center"><a style="background-color:rgb(30, 56, 71);" href="/project-idea-book/projetos?id=<?php echo $book['idBook']?>" class="icon-block btn"><i class="material-icons">visibility</i></a><a style="background-color:rgb(30, 56, 71);margin-left:10px;" data-id="<?php echo $book['idBook']?>" data-title="<?php echo $book['title']?>" data-description="<?php echo $book['description']?>" data-target="modal3" class="modal-trigger icon-block btn botao" href="#modal3"><i class="material-icons">edit</i></a><a style="background-color:rgb(30, 56, 71);margin-left:10px;" data-target="modal2" class="modal-trigger icon-block btn btnEliminar" href="#modal2" data-id="<?php echo $book['idBook']?>"><i class="material-icons">delete</i></a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?php $form = ActiveForm::begin(['action' => ['/idea-book/create'],'options' => ['method' => 'post']]); ?>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5 style="font-weight:bold">Novo livro de ideias</h5>
            <?= $form->field($livro, 'title')->textInput([
                'id' => 'titleInserir',
            ])
            ->label('Título')?>
            <label>Descrição</label>
            <p>
            <?= $form->field($livro, 'description')->widget(alexantr\ckeditor\CKEditor::className())
            ->label(false)?>
        </div>
        <div class="modal-footer">          
            <div style="text-align:center;">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>    
<?php ActiveForm::end(); ?> 
<div id="modal2" class="modal">
    <div class="modal-content">
        <h5 style="font-weight:bold">Eliminar livro de ideias</h5>
        <p style="font-size:20px;margin-top:50px;text-align:center">Tem a certeza que deseja eliminar este livro de ideias?</p>
        <input type="text" id="idEliminar" hidden>
    </div> 
    <div class="modal-footer">
        <div style="text-align:center">
            <?= Html::button('Eliminar', [
                    'class' => 'btn btn-primary',
                    'onclick' =>'
                        $.ajax({
                            type: "post",
                            url: "' . Url::to(['idea-book/delete']) . '?id="+$("#idEliminar").val() ,
                            data:  {},
                            success: function (res) {
                                if(res == "eliminado")
                                {
                                    M.toast({html: "Livro de ideias eliminado com sucesso."});
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
<?php $form = ActiveForm::begin(); ?>
    <div id="modal3" class="modal">
        <div class="modal-content">
            <h5 style="font-weight:bold">Atualizar livro de ideias</h5>
            <?php 
                echo $form->field($livro, 'idBook')
                ->hiddenInput([
                    'id' => 'idBook'
                ])
                ->label(false);
            ?>
            <?= $form->field($livro, 'title')->textInput([
                'id' => 'title',
            ])
            ->label('Título')?>
            <?= alexantr\ckeditor\CKEditor::widget([
                'id' => 'descriptionUpdate',
                'name' => 'descriptionUpdate',
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
                            url: "' . Url::to(['idea-book/update']) . '?id="+$("#idBook").val(),
                            data:  {title: $("#title").val(), description: $("#descriptionUpdate").val()},
                            success: function (res) {
                                if(res == "alterado")
                                {
                                    M.toast({html: "Livro de ideias alterado com sucesso."});
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
<?php
    if (Yii::$app->session->hasFlash('useralterado'))
    { 
        ?>
        <script>
                M.toast({html: 'Informações alteradas com sucesso.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('livroInserido'))
    { 
        ?>
        <script>
                M.toast({html: 'Livro criado com sucesso.'});
        </script>
        <?php
    }
    if (Yii::$app->session->hasFlash('livronull'))
    { 
        ?>
        <script>
                M.toast({html: 'Crie um novo livro de ideias para poder adicionar um projeto.'});
        </script>
        <?php
    }

?>
<script>
    $(document).ready(function(){
        $('.materialboxed').materialbox();
    });
    $('.btnEliminar').on("click",function(){
        var id =  $(this).attr('data-id');
        $('#idEliminar').val(id);
    });
    $(document).ready(function(){
        $('.modal').modal();
    });
</script>
<script>
    $('.botao').on("click",function(){
        var titulo =  $(this).attr('data-title');
        $('#title').val(titulo);
        var descricao =  $(this).attr('data-description');
        $('#descriptionUpdate').val(descricao);
        var id =  $(this).attr('data-id');
        $('#idBook').val(id);
    });
</script>