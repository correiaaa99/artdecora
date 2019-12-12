<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Evalution;

/**
 * EvalutionSearch represents the model behind the search form of `backend\models\Evalution`.
 */
class EvalutionSearch extends Evalution
{
    public $username;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Project_User', 'idProject', 'idUser', 'evalution'], 'integer'],
            [['user.username'], 'safe'],
            [['username'], 'string'],
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
        $query = Evalution::find()
        ->innerJoinWith('project', 'project.idProject = evalution.idProject')
        ->innerJoinWith('user', 'user.idUser = evalution.idUser');

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
            'id_Project_User' => $this->id_Project_User,
            'idProject' => $this->idProject,
            'idUser' => $this->idUser,
            'evalution' => $this->evalution,
        ]);
        $query->andFilterWhere(['like', 'username', $this->username]); 
        return $dataProvider;
    }
}
