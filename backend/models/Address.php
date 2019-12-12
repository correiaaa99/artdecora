<?php

namespace backend\models;
use yii\web\Session;
use Yii;
use backend\models\User;
/**
 * This is the model class for table "tbl_address".
 *
 * @property int $idAddress
 * @property string $address_name
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
            ['address_name', 'required', 'message'=>'É obrigatório preencher o endereço!'],
            ['city', 'required', 'message'=>'É obrigatório preencher a cidade!'],
            ['zip_code', 'required', 'message'=>'É obrigatório preencher o código postal!'],
            [['address_name'], 'string', 'max' => 100],
            [['city'], 'string', 'max' => 50],
            [['zip_code'], 'string', 'max' => 8],
            ['address_name', 'unique', 'targetClass' => '\backend\models\Address', 'message' => 'Esta morada já existe!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAddress' => 'Id Address',
            'address_name' => 'address_name',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Request::className(), ['idAddress' => 'idAddress']);
    }
}
