<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_project".
 *
 * @property int $idProject
 * @property string $name
 * @property string $price
 * @property string $description
 * @property string $date
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'É obrigatório preencher o nome!'],
            ['price', 'required', 'message' => 'É obrigatório preencher o preço!'],
            ['price', 'number'],
            ['date', 'required', 'message' => 'É obrigatório preencher a data!'],
            ['description', 'required', 'message' => 'É obrigatório preencher a descrição!'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['date'], 'string', 'max' => 20],      
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProject' => 'Id Project',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'date' => 'Date',
            'idCategory' => 'idCategory',
            'idDesigner' => 'idDesigner',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['idProject' => 'idProject']);
    }
    public function getDesigners()
    {
       return $this->hasMany(Designer::className(), ['idDesigner' => 'idDesigner'])
           ->viaTable('tbl_designerproject', ['idProject' => 'idProject']);
    }
    public function getCategorys()
    {
       return $this->hasMany(Category::className(), ['idCategory' => 'idCategory'])
           ->viaTable('tbl_projectcategory', ['idProject' => 'idProject']);
    }

    public function getProjectsIdeaBooks()
    {
        return $this->hasMany(ProjectIdeaBook::className(), ['idProject' => 'idProject']);
    }

    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['idProject' => 'idProject']);
    }

    public function getProjects() {
        return $this->hasMany(Project::className(), ['idProject' => 'idProject'])
          ->viaTable('tbl_project_idea_book', ['idProject' => 'idProject']);
    }

    public function getEvalution()
    {
        return $this->hasMany(Evalution::className(), ['idProject' => 'idProject']);
    }
}
