<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_project_user".
 *
 * @property int $id_Project_User
 * @property int $idProject
 * @property int $idUser
 * @property float $evalution
 */
class Evalution extends \yii\db\ActiveRecord
{
    public $avaliacao;
    public $contador;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_project_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProject', 'idUser', 'evalution'], 'required'],
            [['idProject', 'idUser'], 'integer'],
            [['evalution'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Project_User' => 'Id Project User',
            'idProject' => 'Id Project',
            'idUser' => 'Id User',
            'evalution' => 'Evalution',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['idUser' => 'idUser']);
    }
}
