<?php

namespace backend\models;
use yii\web\Session;
use Yii;
use backend\models\User;
/**
 * This is the model class for table "tbl_address".
 *
 * @property int $idAddress
 * @property string $name
 * @property string $city
 * @property string $zip_code
 * @property int $idUser
 *
 * @property TblUser $user
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message'=>'É obrigatório preencher o endereço!'],
            ['city', 'required', 'message'=>'É obrigatório preencher a cidade!'],
            ['zip_code', 'required', 'message'=>'É obrigatório preencher o código postal!'],
            [['name'], 'string', 'max' => 100],
            [['city'], 'string', 'max' => 50],
            [['zip_code'], 'string', 'max' => 8],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAddress' => 'Id Address',
            'name' => 'Name',
            'city' => 'City',
            'zip_code' => 'Zip Code',
            'idUser' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['idUser' => 'idUser']);
    }
}
