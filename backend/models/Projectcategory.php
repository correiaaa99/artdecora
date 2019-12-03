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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['idCategory' => 'idCategory']);
    }
    public function getCategorys() {
        $categorias = Category::find()->select('tbl_category.*')
        ->leftJoin('tbl_projectcategory','tbl_category.idCategory = tbl_projectcategory.idCategory')
        ->where(['tbl_projectcategory.idCategory' => NULL])->all();
        return $categorias;
    }
}
