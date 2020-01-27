<?php

namespace frontend\controllers;
use Yii;
use frontend\models\ProjectIdeaBook;
use frontend\models\IdeaBook;
class ProjectIdeaBookController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['projetos', 'create', 'index', 'update'],
                'rules' => [                
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }
    public function actionProjetos($id)
    {
        $projetosIdeaBook = ProjectIdeaBook::find()
            ->select(['tbl_project_idea_book.id_Project_idea_book','tbl_project_idea_book.idProject','tbl_project_idea_book.idBook','tbl_project_idea_book.title','tbl_project_idea_book.comment' ,'tbl_image.name AS imagem'])->distinct()
            ->from(['tbl_project'])
            ->innerJoin('tbl_project_idea_book' ,'tbl_project_idea_book.idProject = tbl_project.idProject')
            ->leftJoin('tbl_image' ,'tbl_image.idProject = tbl_project_idea_book.idProject')
            ->where(['tbl_project_idea_book.idBook' => $id])
            ->groupBy(['tbl_project.idProject'])
            ->asArray()
            ->all();
        $book = IdeaBook::find()
        ->select(['tbl_ideabook.title', 'tbl_ideabook.date'])
        ->from(['tbl_ideabook'])
        ->where(['idBook' => $id])
        ->limit(1)
        ->one();

        $projetoIdeabook = new ProjectIdeaBook();

        return $this->render('projetos', [
            'projetos' => $projetosIdeaBook,
            'book' => $book,
            'projetoUpdate' => $projetoIdeabook,
        ]);
        
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {
        $livro = new ProjectIdeaBook();
        if($livro->load(Yii::$app->request->post()))
        {
            if($livro->idBook != null)
            {
                //testar se o projeto selecionado já está associado ao livro
                $projectBook = ProjectIdeaBook::findByProjectAndBook($livro->idProject,$livro->idBook);
                if($projectBook)
                {
                    Yii::$app->session->setFlash('projetoassociado', 'projetoassociado');
                    return $this->redirect(['site/index']);
                }
                else
                {
                    Yii::$app->session->setFlash('projetoassociadosucesso', 'projetoassociadosucesso');
                    $livro->save();
                    return $this->redirect(['site/index']); 
                }
            }
            else
            {
                Yii::$app->session->setFlash('livronull', 'livronull');
                return $this->redirect(['user/perfil']);
            }
        }
    }
    public function actionUpdate($id)
    {
        $projectIdeaBookUpdate = $this->findModel($id);
        if(Yii::$app->request->isAjax)  {
            $data = Yii::$app->request->post();
            $title = $data['title'];
            $comment = $data['comment'];;
            $projectIdeaBookUpdate->title = $title;
            $projectIdeaBookUpdate->comment = $comment;
           if($projectIdeaBookUpdate->save())
           {
               return "alterado";
           }
        }
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        return "eliminado";
    }
    protected function findModel($id) {
        if (($model = ProjectIdeaBook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 

}
