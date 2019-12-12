<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Request;

/**
 * RequestSearch represents the model behind the search form of `backend\models\Request`.
 */
class RequestSearch extends Request
{
    public $username;
    public $address_name;
    public $name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRequest', 'idUser', 'idProject', 'idAddress'], 'integer'],
            [['description', 'status', 'user.username', 'address.address_name'], 'safe'],
            [['username', 'address_name'], 'string'],
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
        $query = Request::find()->innerJoinWith('address', true)
        ->innerJoinWith('user', true);

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
            'idRequest' => $this->idRequest,
            'idUser' => $this->idUser,
            'idProject' => $this->idProject,
            'idAddress' => $this->idAddress,
            
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['like', 'username', $this->username])
        ->andFilterWhere(['like', 'address_name', $this->address_name]);                             
        return $dataProvider;
    }
}
