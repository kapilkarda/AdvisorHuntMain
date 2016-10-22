<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\City;


/**
 * CitySearch represents the model behind the search form about `backend\models\City`.
 */
class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'state_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = City::find();

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
        
        $query->joinWith('state');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//             'state_id' => $this->state_id, //Comented by Aninda 6/7
        ]);

        $query->andFilterWhere(['like', 'city.name', $this->name]) // Modified by Aninda 6/7
        		->andFilterWhere(['like', 'state.name', $this->state_id]) //Added by Aninda 6/7
        		->andFilterWhere(['like', 'city.slug', $this->slug]); //Added by Aninda 6/7
//         $query->andWhere('dt_deleted_at IS NULL');

        return $dataProvider;
    }
}
