<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyReviewByExternalCompany;

/**
 * CompanyReviewByExternalCompanySearch represents the model behind the search form about `backend\models\CompanyReviewByExternalCompany`.
 */
class CompanyReviewByExternalCompanySearch extends CompanyReviewByExternalCompany
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_company_id'], 'integer'],
            [['s_yelp_rating_url', 's_google_rating', 's_BBB_ratings'], 'safe'],
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
        $query = CompanyReviewByExternalCompany::find();

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
        ]);

        $query->andFilterWhere(['like', 's_yelp_rating_url', $this->s_yelp_rating_url])
            ->andFilterWhere(['like', 's_google_rating', $this->s_google_rating])
            ->andFilterWhere(['like', 's_BBB_ratings', $this->s_BBB_ratings]);

        return $dataProvider;
    }
}
