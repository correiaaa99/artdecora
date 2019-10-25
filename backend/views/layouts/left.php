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
                    ['label' => 'Utilizadores', 'icon' => ' fa-user', 'url' => '#'],
                    ['label' => 'Pedidos', 'icon' => ' fa-calendar', 'url' => '/gii'],
                    ['label' => 'Livros de ideias', 'icon' => ' fa-book', 'url' => '/debug'],       
                    ['label' => 'Designers', 'icon' => ' fa-users', 'url' => '#'],   
                    ['label' => 'Projetos', 'icon' => ' fa-home', 'url' => '#'],  
                    ['label' => 'Categorias', 'icon' => ' fa-image', 'url' => '#'], 
                    ['label' => 'Foo', 'url' => ['/admin/index']],      
                ],
            ]
        
        ) ?>
    </section>

</aside>
