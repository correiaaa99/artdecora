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
        $auth->addChild($admin, $subAdmin);
        
        // Atribui roles para usuários. 1 and 2 são IDs retornados por IdentityInterface::getId()
        // normalmente implementado no seu model User.
        $auth->assign($admin, 1);
        $auth->assign($subAdmin, 2);
   }
}