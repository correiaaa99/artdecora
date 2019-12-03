<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Session;
use backend\models\Image;
/**
 * ImageSearch represents the model behind the search form of `backend\models\Image`.
 */
class ImageSearch extends Image
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idImage', 'idRequest', 'idProject'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $session = Yii::$app->session;
        $projeto = $session->get('projeto');
        $query = Image::find()->where(['idProject' => $projeto]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idImage' => $this->idImage,
            'idRequest' => $this->idRequest,
            'idProject' => $this->idProject,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
