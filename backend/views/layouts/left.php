<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/admin.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href=""><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Utilizadores', 'icon' => ' fa-user', 'url' => '/user/index'],
                    ['label' => 'Pedidos', 'icon' => ' fa-calendar', 'url' => '/request/index'],
                    ['label' => 'Livros de ideias', 'icon' => ' fa-book', 'url' => '/idea-book/index'],       
                    ['label' => 'Designers', 'icon' => ' fa-users', 'url' => '/designer/index'],   
                    ['label' => 'Projetos', 'icon' => ' fa-home', 'url' => '/project/index'],  
                    ['label' => 'Categorias', 'icon' => ' fa-image', 'url' => '/category/index'], 
                    ['label' => 'Avaliações', 'icon' => 'fa fa-bar-chart', 'url' => '/evalution/index'],    
                ],
            ]
        
        ) ?>
    </section>

</aside>
