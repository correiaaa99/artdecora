<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_ideabook".
 *
 * @property int $idBook
 * @property string $description
 * @property string $title
 * @property string $date
 * @property int $idUser
 */
class IdeaBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ideabook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['description', 'required', 'message' => 'É obrigatório preencher a descrição!'],
            ['title', 'required', 'message' => 'É obrigatório preencher o título'],
            [['description'], 'string'],
            [['idUser'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['date'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idBook' => 'Id Book',
            'description' => 'Description',
            'title' => 'Title',
            'date' => 'Date',
            'idUser' => 'Id User',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['idUser' => 'idUser']);
    }
    public function getProjetos()
    {
        return $this->hasMany(ProjectIdeaBook::className(), ['idBook' => 'idBook']);
    }
}
