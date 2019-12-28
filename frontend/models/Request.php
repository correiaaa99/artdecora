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
            [['description', 'idUser', 'idAddress', 'status'], 'required'],
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
}
