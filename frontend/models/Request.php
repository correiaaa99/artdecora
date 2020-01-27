<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_request".
 *
 * @property int $idRequest
 * @property string $description
 * @property int $idUser
 * @property int|null $idProject
 * @property int $idAddress
 * @property string $status
 */
class Request extends \yii\db\ActiveRecord
{
    public $estado;
    public $endereco;
    public $descricao;
    public $name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['description', 'required', 'message' => 'É obrigatório preencher a descrição!'],
            ['idAddress', 'required', 'message' => 'É obrigatório preencher o endereço!'],
            [['idUser','status'], 'required'],
            [['description'], 'string'],
            [['idUser', 'idProject', 'idAddress'], 'integer'],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRequest' => 'Id Request',
            'description' => 'Description',
            'idUser' => 'Id User',
            'idProject' => 'Id Project',
            'idAddress' => 'Id Address',
            'status' => 'Status',
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['idUser' => 'idUser']);
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
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['idAddress' => 'idAddress']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['idRequest' => 'idRequest']);
    }
}
