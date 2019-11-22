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
            [['name', 'price', 'description', 'date'], 'required'],
            [['price'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
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
        ];
    }
    public function beforeSave($insert) 
    {   
        if (parent::beforeSave($insert)) 
        {
            $this->price = str_replace(",", ".", $this->prod_price);
            return true;
        } 
        else 
        {

            return false;

        }
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
}
