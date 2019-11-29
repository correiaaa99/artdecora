<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_designer".
 *
 * @property int $idDesigner
 * @property string $name
 */
class Designer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_designer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'],'required', 'message' => 'É obrigatório preencher o nome!'],
            [['name'], 'string', 'max' => 100],
            [['email'],'required', 'message' => 'É obrigatório preencher o email!'],
            ['email', 'unique', 'targetClass' => '\backend\models\Designer', 'message' => 'Este email já existe!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idDesigner' => 'Id Designer',
            'name' => 'Name',
        ];
    }
}
