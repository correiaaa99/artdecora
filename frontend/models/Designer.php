<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_designer".
 *
 * @property int $idDesigner
 * @property string $name
 * @property string $email
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
            [['name', 'email'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
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
            'email' => 'Email',
        ];
    }
}
