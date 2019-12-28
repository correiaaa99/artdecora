<?php

namespace backend\models;
use yii\web\Session;
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
    public function getDesigner()
    {
        return $this->hasOne(Designer::className(), ['idDesigner' => 'idDesigner']);
    }
    public function getDesigners() {
        $session = Yii::$app->session;
        $projeto = $session->get('projeto');
        $designers = Designer::find()->select('tbl_designer.*')
        ->leftJoin('tbl_designerproject','tbl_designer.idDesigner = tbl_designerproject.idDesigner')
        ->where(['tbl_designer.idDesigner' => NULL])
        ->andWhere(['=', 'tbl_designerproject.idProject', $projeto])
        ->all();
        return $designers;

    }
    
}
