<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
   public function actionInit()
   {
       $auth = Yii::$app->authManager;
       
        //Gestão de users
        $createUser = $auth->createPermission('criarUser');
        $createUser->description = 'Criar um user';
        $auth->add($createUser);

        $atualizarUser = $auth->createPermission('atualizarUser');
        $atualizarUser->description = 'Atualizar um user';
        $auth->add($atualizarUser);

        $eliminarUser = $auth->createPermission('eliminarUser');
        $eliminarUser->description = 'Eliminar um user';
        $auth->add($eliminarUser);

        $verUsers = $auth->createPermission('verUsers');
        $verUsers->description = 'Ver users';
        $auth->add($verUsers);

        //Gestão de categorias
        $createCategory = $auth->createPermission('criarCategory');
        $createCategory->description = 'Criar uma categoria ';
        $auth->add($createCategory);

        $atualizarCategory = $auth->createPermission('atualizarCategory');
        $atualizarCategory->description = 'Atualizar uma categoria ';
        $auth->add($atualizarCategory);

        $eliminarCategory = $auth->createPermission('eliminarCategory');
        $eliminarCategory->description = 'Eliminar uma categoria';
        $auth->add($eliminarCategory);

        $verCategorys = $auth->createPermission('verCategorias');
        $verCategorys->description = 'Ver categorias';
        $auth->add($verCategorys);

        //Gestão de designers
        $createDesigner = $auth->createPermission('criarDesigner');
        $createDesigner->description = 'Criar um designer';
        $auth->add($createDesigner);

        $atualizarDesigner = $auth->createPermission('atualizarDesigner');
        $atualizarDesigner->description = 'Atualizar um designer';
        $auth->add($atualizarDesigner);

        $eliminarDesigner = $auth->createPermission('eliminarDesigner');
        $eliminarDesigner->description = 'Eliminar um designer';
        $auth->add($eliminarDesigner);

        $verDesigners = $auth->createPermission('verDesigners');
        $verDesigners->description = 'Ver designers';
        $auth->add($verDesigners);

        //Gestão de livros
        $createLivro = $auth->createPermission('criarLivro');
        $createLivro->description = 'Criar um livro';
        $auth->add($createLivro);

        $atualizarLivro = $auth->createPermission('atualizarLivro');
        $atualizarLivro->description = 'Atualizar um livro';
        $auth->add($atualizarLivro);

        $eliminarLivro = $auth->createPermission('eliminarLivro');
        $eliminarLivro->description = 'Eliminar um livro';
        $auth->add($eliminarLivro);

        $verLivros = $auth->createPermission('verLivros');
        $verLivros->description = 'Ver livros';
        $auth->add($verLivros);

        //Gestão de projetos
        $createProjeto = $auth->createPermission('criarProjeto');
        $createProjeto->description = 'Criar um projeto';
        $auth->add($createProjeto);

        $atualizarProjeto = $auth->createPermission('atualizarProjeto');
        $atualizarProjeto->description = 'Atualizar um projeto';
        $auth->add($atualizarProjeto);

        $eliminarProjeto = $auth->createPermission('eliminarProjeto');
        $eliminarProjeto->description = 'Eliminar um projeto';
        $auth->add($eliminarProjeto);

        $verProjetos = $auth->createPermission('verProjetos');
        $verProjetos->description = 'Ver projetos';
        $auth->add($verProjetos);

        //Gestão de pedidos
        $createPedido = $auth->createPermission('criarPedido');
        $createPedido->description = 'Criar um pedido';
        $auth->add($createPedido);

        $atualizarPedido = $auth->createPermission('atualizarPedido');
        $atualizarPedido->description = 'Atualizar um pedido';
        $auth->add($atualizarPedido);

        $eliminarPedido = $auth->createPermission('eliminarPedido');
        $eliminarPedido->description = 'Eliminar um pedido';
        $auth->add($eliminarPedido);

        $verPedidos = $auth->createPermission('verPedidos');
        $verPedidos->description = 'Ver pedidos';
        $auth->add($verPedidos);

        //Gestão de imagens
        $createImagem = $auth->createPermission('criarImagem');
        $createImagem->description = 'Criar uma imagem';
        $auth->add($createImagem);

        $atualizarImagem = $auth->createPermission('atualizarImagem');
        $atualizarImagem->description = 'Atualizar uma imagem';
        $auth->add($atualizarImagem);

        $eliminarImagem = $auth->createPermission('eliminarImagem');
        $eliminarImagem->description = 'Eliminar uma imagem';
        $auth->add($eliminarImagem);

        $verImagens = $auth->createPermission('verImagens');
        $verImagens->description = 'Ver imagens';
        $auth->add($verImagens);

        //Gestão de designers nos projetos
        $createDesignerProjeto = $auth->createPermission('criarDesignerProjeto');
        $createDesignerProjeto->description = 'Criar um designer no projeto';
        $auth->add($createDesignerProjeto);

        $atualizarDesignerProjeto = $auth->createPermission('atualizarDesignerProjeto');
        $atualizarDesignerProjeto->description = 'Atualizar um designer no projeto';
        $auth->add($atualizarDesignerProjeto);

        $eliminarDesignerProjeto = $auth->createPermission('eliminarDesignerProjeto');
        $eliminarDesignerProjeto->description = 'Eliminar um designer no projeto';
        $auth->add($eliminarDesignerProjeto);

        $verDesignersProjeto = $auth->createPermission('verDesignersProjeto');
        $verDesignersProjeto->description = 'Ver designers no projeto';
        $auth->add($verDesignersProjeto);

        //Gestão de categorias nos projetos
        $createCategoriaProjeto = $auth->createPermission('criarCategoriaProjeto');
        $createCategoriaProjeto->description = 'Criar uma categoria no projeto';
        $auth->add($createCategoriaProjeto);

        $atualizarCategoriaProjeto = $auth->createPermission('atualizarCategoriaProjeto');
        $atualizarCategoriaProjeto->description = 'Atualizar uma categoria no projeto';
        $auth->add($atualizarCategoriaProjeto);

        $eliminarCategoriaProjeto = $auth->createPermission('eliminarCategoriaProjeto');
        $eliminarCategoriaProjeto->description = 'Eliminar uma categoria no projeto';
        $auth->add($eliminarCategoriaProjeto);

        $verCategoriasProjeto = $auth->createPermission('verCategoriasProjeto');
        $verCategoriasProjeto->description = 'Ver categorias no projeto';
        $auth->add($verCategoriasProjeto);

        //Gestão de projetos nos livros
        $createProjetoLivro = $auth->createPermission('criarProjetoLivro');
        $createProjetoLivro->description = 'Criar um projeto no livro';
        $auth->add($createProjetoLivro);

        $atualizarProjetoLivro = $auth->createPermission('atualizarProjetoLivro');
        $atualizarProjetoLivro->description = 'Atualizar um projeto no livro';
        $auth->add($atualizarProjetoLivro);

        $eliminarProjetoLivro = $auth->createPermission('eliminarProjetoLivro');
        $eliminarProjetoLivro->description = 'Eliminar um projeto no livro';
        $auth->add($eliminarProjetoLivro);

        $verProjetosLivro = $auth->createPermission('verProjetosLivro');
        $verProjetosLivro->description = 'Ver projetos no livro';
        $auth->add($verProjetosLivro);

        //Gestão de moradas
        $createMorada = $auth->createPermission('criarMorada');
        $createMorada->description = 'Criar uma morada';
        $auth->add($createMorada);

        $atualizarMorada = $auth->createPermission('atualizarMorada');
        $atualizarMorada->description = 'Atualizar uma morada';
        $auth->add($atualizarMorada);

        $eliminarMorada = $auth->createPermission('eliminarMorada');
        $eliminarMorada->description = 'Eliminar uma morada';
        $auth->add($eliminarMorada);

        $verMoradas = $auth->createPermission('verMoradas');
        $verMoradas->description = 'Ver moradas';
        $auth->add($verMoradas);

        //Criar role do subAdmin e atribuir permissões
        $subAdmin = $auth->createRole('subAdmin');
        $auth->add($subAdmin);
        $auth->addChild($subAdmin, $verUsers);
        $auth->addChild($subAdmin, $verCategorys);
        $auth->addChild($subAdmin, $verDesigners);
        $auth->addChild($subAdmin, $verLivros);
        $auth->addChild($subAdmin, $verProjetos);
        $auth->addChild($subAdmin, $verPedidos);

        //Criar role de Admin e atribuir permissões juntamente com as do subAdmin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $atualizarUser);
        $auth->addChild($admin, $eliminarUser);
        $auth->addChild($admin, $createCategory);
        $auth->addChild($admin, $atualizarCategory);
        $auth->addChild($admin, $eliminarCategory);
        $auth->addChild($admin, $createDesigner);
        $auth->addChild($admin, $atualizarDesigner);
        $auth->addChild($admin, $eliminarDesigner);
        $auth->addChild($admin, $createLivro);
        $auth->addChild($admin, $atualizarLivro);
        $auth->addChild($admin, $eliminarLivro);
        $auth->addChild($admin, $createProjeto);
        $auth->addChild($admin, $atualizarProjeto);
        $auth->addChild($admin, $eliminarProjeto);
        $auth->addChild($admin, $createPedido);
        $auth->addChild($admin, $atualizarPedido);
        $auth->addChild($admin, $eliminarPedido);
        $auth->addChild($admin, $createImagem);
        $auth->addChild($admin, $atualizarImagem);
        $auth->addChild($admin, $eliminarImagem);
        $auth->addChild($admin, $verImagens);
        $auth->addChild($admin, $createDesignerProjeto);
        $auth->addChild($admin, $atualizarDesignerProjeto);
        $auth->addChild($admin, $eliminarDesignerProjeto);
        $auth->addChild($admin, $verDesignersProjeto);
        $auth->addChild($admin, $createCategoriaProjeto);
        $auth->addChild($admin, $atualizarCategoriaProjeto);
        $auth->addChild($admin, $eliminarCategoriaProjeto);
        $auth->addChild($admin, $verCategoriasProjeto);
        $auth->addChild($admin, $createMorada);
        $auth->addChild($admin, $atualizarMorada);
        $auth->addChild($admin, $eliminarMorada);
        $auth->addChild($admin, $verMoradas);
        $auth->addChild($admin, $createProjetoLivro);
        $auth->addChild($admin, $atualizarProjetoLivro);
        $auth->addChild($admin, $eliminarProjetoLivro);
        $auth->addChild($admin, $verProjetosLivro);
        $auth->addChild($admin, $subAdmin);
        
        // Atribui roles para usuários. 1 and 2 são IDs retornados por IdentityInterface::getId()
        // normalmente implementado no seu model User.
        $auth->assign($admin, 1);
        $auth->assign($subAdmin, 2);
   }
}