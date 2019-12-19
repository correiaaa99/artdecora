<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_project_idea_book".
 *
 * @property int $id_Project_idea_book
 * @property int $idProject
 * @property int $idBook
 * @property string $title
 * @property string $comment
 */
class ProjectIdeaBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_project_idea_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProject'], 'required'],
            ['idBook', 'required', 'message' => 'É obrigatório selecionar um livro de ideias!'],
            ['title', 'required', 'message' => 'É obrigatório preencher o título!'],
            ['comment', 'required', 'message' => 'É obrigatório preencher o comentário!'],
            [['idProject', 'idBook'], 'integer'],
            [['comment'], 'string'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Project_idea_book' => 'Id Project Idea Book',
            'idProject' => 'Id Project',
            'idBook' => 'Id Book',
            'title' => 'Title',
            'comment' => 'Comment',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['idProject' => 'idProject']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLivro()
    {
        return $this->hasOne(IdeaBook::className(), ['idBook' => 'idBook']);
    }
    public static function findByProjectAndBook($idProject,$idBook)
    {
        return static::findOne(['idProject' => $idProject, 'idBook' => $idBook]);
    }
}
