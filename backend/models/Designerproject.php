<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_designerproject}}".
 *
 * @property int $id_Designer_Project
 * @property int $idDesigner
 * @property int $idProject
 */
class Designerproject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_designerproject}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idDesigner'], 'integer'],
            ['idDesigner', 'required', 'message' => 'É obrigatório preencher pelo menos um designer!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Designer_Project' => 'Id Designer Project',
            'idDesigner' => 'Id Designer',
            'idProject' => 'Id Project',
        ];
    }
    
}
