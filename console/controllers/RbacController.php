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

       //Gestão de categorias
       $createCategory = $auth->createPermission('criarCategory');
       $createUser->description = 'Criar uma categoria ';
       $auth->add($createCategory);

       //Criar role do subAdmin e atribuir permissões
       $subAdmin = $auth->createRole('subAdmin');
       $auth->add($subAdmin);
       $auth->addChild($subAdmin, $createCategory);

       //Criar role de Admin e atribuir permissões juntamente com as do subAdmin
       $admin = $auth->createRole('admin');
       $auth->add($admin);
       $auth->addChild($admin, $createUser);
       $auth->addChild($admin, $atualizarUser);
       $auth->addChild($admin, $eliminarUser);
       $auth->addChild($admin, $subAdmin);

       // Atribui roles para usuários. 1 and 2 são IDs retornados por IdentityInterface::getId()
       // normalmente implementado no seu model User.
       $auth->assign($admin, 1);
       $auth->assign($subAdmin, 2);
   }
}