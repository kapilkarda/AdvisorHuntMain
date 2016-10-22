<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Token;

/**
 * TokenSearch represents the model behind the search form about `backend\models\Token`.
 */
class TokenSearch extends Token
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_sub_category_id', 'fk_i_zip_id', 'i_project_cost_range_from', 'i_project_cost_range_to', 'i_token_count'], 'integer'],
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
        $query = Token::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->joinWith('city');
        $query->joinWith('zipcode');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pk_i_id' => $this->pk_i_id,
            'fk_i_sub_category_id' => $this->fk_i_sub_category_id,
            // 'fk_i_zip_id' => $this->fk_i_zip_id,
            'i_project_cost_range_from' => $this->i_project_cost_range_from,
            'i_project_cost_range_to' => $this->i_project_cost_range_to,
            'i_token_count' => $this->i_token_count,
        ]);
        $query->andFilterWhere(['like', 'city.name', $this->city_id])
                ->andFilterWhere(['like', 'zipcode.zip', $this->fk_i_zip_id]);
        $query->andWhere('token.dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
