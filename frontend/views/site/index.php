<!-- Compiled and minified CSS -->
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.0.0/nouislider.min.css' rel="stylesheet">
<script src='https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/9.0.0/nouislider.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.0.4/wNumb.min.js'></script>
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
    #precoMinimo:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    #precoMaximo:focus {
        border-bottom: 1px solid #BD9056;
        box-shadow: 0 1px 0 0 #BD9056;
    }
    .noUi-connect {
        background:rgb(30, 56, 71);
    }
    .input-icons i { 
        position: absolute; 
    }  
    .input-icons { 
        width: 100%; 
        margin-bottom: 10px; 
    }    
    .icon { 
        padding: 15px; 
        min-width: 40px; 
    }     
    .input-field { 
        width: 100%; 
        padding: 10px; 
        text-align: center; 
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
use frontend\models\Category;

/* @var $this yii\web\View */
$this->title = 'Página inicial';
//definir preco minimo e maximo 
$precoMinimo = 1000;
$precoMaximo = 50000;
?>
<body>
    <div class="site-index" >
        <div class="jumbotron">
            <img id="imagem" src="/imagens/site/imagem3.png" style="width:100%;height:541px;">
        </div>
        <h3 style="font-size:33px;font-weight:900;font-family:;text-align:center;color:rgb(30, 56, 71);">Os nossos projetos</h3>
        <h3 style="font-size:22px;font-weight:700;font-family:;text-align:center;color:rgb(30, 56, 71);">Pesquisa avançada</h3>
        <div class="row">
            <div class="col m4 s0">
            </div>
            <div class="col m4 s12">
                <?php $data = ArrayHelper::map(Category::find()->all(), 'idCategory', 'name');
                    echo Html::dropdownList('idCategory', 'Selecione uma categoria', $data, 
                    [
                        'id' => 'dropdownCategorias',
                    ])
                ?>
            </div>
            <div class="col m4 s0">
            </div>
        </div>
        <div class="row">
            <div class="col m2"></div>
            <div class="col m2 s12">
                <div class="input-icons">
                    <i style="font-size:21px;" class="material-icons icon">euro_symbol</i>
                    <input type="number" class="input-field" name="precoMinimo" id="precoMinimo" value=<?php echo $precoMinimo;?>>
                </div>
            </div>
            <div class="col m4 s12">
                <div style="margin-top:34px;" class="preco_range" id="preco_range"></div>
            </div>
            <div class="col m2 s12">
                <div class="input-icons">
                    <i style="font-size:21px;" class="material-icons icon">euro_symbol</i>
                    <input type="number" class="input-field" name="precoMaximo" id="precoMaximo" value=<?php echo $precoMaximo; ?>> 
                </div>
            </div>
        </div>
        <div class="body-content">
        <?php Pjax::begin() ?>
            <div class="row">
                <div class="col m12 s12">
                    <div class="divProjetos">
                        <div class="row">
                            <?php 
                            foreach($dataProjects as $project)
                            {
                            ?>
                            <div class="col s6 m3">
                                <div class="card">
                                    <div class="card-image">
                                        <div class="guardar">
                                            <?php foreach($project->images as $image) : ?>
                                                <img class="image" style="height:210px;" src="http://backend.test/<?php echo $image->name?>">
                                                <div class="button">
                                                    <?php if (!Yii::$app->user->isGuest) 
                                                    {
                                                        ?>
                                                        <div class="middle"><a id="<?php echo $project->idProject?>" style="background-color:rgb(30, 56, 71);" class="waves-effect waves-light btn modal-trigger botao " href="#modal1"><i class="material-icons right">add</i>Guardar</a></div>
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
                                                <?php break;?>      
                                            <?php endforeach; ?>
                                        </div>  
                                    </div>
                                    <div style="height:170px;margin-top:-40px" class="card-content">
                                        <p style="font-weight:bold;font-size:20px;"><?php echo $project->name;?></p>
                                        <p><?php echo $project->description?></p>
                                    </div>
                                    <div class="card-action">
                                        <a style="color:rgb(30, 56, 71);" href="/project/detalhes?id=<?php echo $project->idProject?>">Detalhes</a>
                                    </div>
                                </div>
                            </div>                                 
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                    echo LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                ?>
            </div>
        </div>
    </body>
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
                    <div class="input-field col s12 m12">    
                        <?= $form->field($livro, 'title')->textInput([
                            'id' => 'titulo',
                        ])
                        ->label('Título')?>
                    </div>
                </div> 
                <div class="row">
                    <div class="input-field col s12 m12">
                        <?= $form->field($livro, 'comment')->widget(alexantr\ckeditor\CKEditor::className())
                        ->label('Comentário')?>
                    </div>
                </div>
                <div style="text-align:center;">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
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
    if (Yii::$app->session->hasFlash('avaliacao'))
    { 
        ?>
        <script>
                M.toast({html: 'Inicie sessão para avaliar o projeto.'});
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
        function myFunction() {
            M.toast({html: 'Inicie sessão para poder adicionar um projeto a um livro de ideias.'});
        }
    </script>
    <script>
        $('#dropdownCategorias').on('change', function() {
            $.ajax({
                url: '<?php echo Yii::$app->request->baseUrl. '/site/category' ?>',
                type: 'post',
                data: {categoria: $('#dropdownCategorias option:selected').val(), nome: $('#dropdownCategorias option:selected').text()},
                success: function (data) {
                    $(".divProjetos").html("");
                    $(".divProjetos").append(data); 
                },
            });
        });
    </script>
    <script>
        $(".botao").click(function(){
            $('#projeto').val(this.id);
            $('#comentario').val('');
            $('#titulo').val(''); 
        });
    </script>
    <script>
        $(function(){
            var slider = document.getElementById('preco_range');
            noUiSlider.create(slider, {
            start: [<?php echo $precoMinimo;?>, <?php echo $precoMaximo;?>],
            connect: true,
            step: 1,
                range: {
                    'min': <?php echo $precoMinimo;?>,
                    'max': <?php echo $precoMaximo;?>,
                },
                format: wNumb({
                    decimals: 0
                })
            });
        });
        $(document).ready(function() {
            var slider = document.getElementById('preco_range');
            var inputMinimo = document.getElementById('precoMinimo');
            var inputMaximo = document.getElementById('precoMaximo');
            slider.noUiSlider.on('update', function(values, handle){
                inputMinimo.value = values[0];
                inputMaximo.value = values[1];  
            });
            slider.noUiSlider.on('change', function(values, handle){
                ajaxRequest(values[0], values[1]);
            });
            inputMinimo.addEventListener('change', function () {
                slider.noUiSlider.set([this.value, null]);
                ajaxRequest($('#precoMinimo').val(), $('#precoMaximo').val());
            });
            inputMaximo.addEventListener('change', function () {
                slider.noUiSlider.set([null, this.value]);
                ajaxRequest($('#precoMinimo').val(), $('#precoMaximo').val());
            });
            function ajaxRequest(valorMinimo, valorMaximo)
            {
                $.ajax({
                    url: '<?php echo Yii::$app->request->baseUrl. '/site/price' ?>',
                    type: 'post',
                    data: {precoMinimo: valorMinimo, precoMaximo: valorMaximo},
                    success: function (data) {
                        $(".divProjetos").html("");
                        $(".divProjetos").append(data); 
                    },
                });
            }
        });
    </script>
</div>
