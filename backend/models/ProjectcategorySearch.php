<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Projectcategory;
use yii\web\Session;

/**
 * ProjectcategorySearch represents the model behind the search form of `backend\models\Projectcategory`.
 */
class ProjectcategorySearch extends Projectcategory
{
    public $name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_Project_Category', 'idProject', 'idCategory'], 'integer'],
            [['category.name'], 'safe'],
            [['name'], 'string'],
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
        $query = Projectcategory::find()
        ->innerJoinWith('category', true)
        ->where(['idProject' => $projeto]);

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
            'id_Project_Category' => $this->id_Project_Category,
            'idProject' => $this->idProject,
            'idCategory' => $this->idCategory,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name]); 

        return $dataProvider;
    }
}
