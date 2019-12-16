<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_project".
 *
 * @property int $idProject
 * @property string $name
 * @property float $price
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
            [['price'], 'number'],
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
    public function getImages()
    {
        return $this->hasMany(Project::className(), ['idProject' => 'idProject']);
    }
}
