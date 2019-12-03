<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProjectIdeaBook;

/**
 * ProjectIdeaBookSearch represents the model behind the search form of `backend\models\ProjectIdeaBook`.
 */
class ProjectIdeaBookSearch extends ProjectIdeaBook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Project_idea_book', 'idProject', 'idBook'], 'integer'],
            [['title', 'comment'], 'safe'],
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
        $query = ProjectIdeaBook::find();

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
            'id_Project_idea_book' => $this->id_Project_idea_book,
            'idProject' => $this->idProject,
            'idBook' => $this->idBook,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
