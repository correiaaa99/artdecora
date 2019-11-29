<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_projectcategory}}".
 *
 * @property int $id_Project_Category
 * @property int $idProject
 * @property int $idCategory
 */
class Projectcategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_projectcategory}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCategory'], 'integer'],
            ['idCategory', 'required', 'message' => 'É obrigatório preencher pelo menos uma categoria!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Project_Category' => 'Id Project Category',
            'idProject' => 'Id Project',
            'idCategory' => 'Id Category',
        ];
    }
}
