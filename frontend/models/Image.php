<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_image".
 *
 * @property int $idImage
 * @property string $name
 * @property int|null $idRequest
 * @property int|null $idProject
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['idRequest', 'idProject'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idImage' => 'Id Image',
            'name' => 'Name',
            'idRequest' => 'Id Request',
            'idProject' => 'Id Project',
        ];
    }

    public function getProject()
    {
        return $this->hasOne(Image::className(), ['idProject' => 'idProject']);
    }
}
