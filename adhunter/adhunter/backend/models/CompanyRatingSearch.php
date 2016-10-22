<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyRating;

/**
 * CompanyRatingSearch represents the model behind the search form about `backend\models\CompanyRating`.
 */
class CompanyRatingSearch extends CompanyRating
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_company_id', 'i_rating', 'fk_i_comment_id'], 'integer'],
            [['s_rating_category', 's_review_by', 'dt_review_date'], 'safe'],
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
        $query = CompanyRating::find();

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
            'pk_i_id' => $this->pk_i_id,
            'fk_i_company_id' => $this->fk_i_company_id,
            'i_rating' => $this->i_rating,
            'dt_review_date' => $this->dt_review_date,
            'fk_i_comment_id'=> $this->fk_i_comment_id,
        ]);

        $query->andFilterWhere(['like', 's_rating_category', $this->s_rating_category])
            ->andFilterWhere(['like', 's_review_by', $this->s_review_by]);

        return $dataProvider;
    }
}
