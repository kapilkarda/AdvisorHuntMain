<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Lead;

/**
 * LeadSearch represents the model behind the search form about `backend\models\Lead`.
 */
class LeadSearch extends Lead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_sub_category_id', 'fk_i_city_id', 'fk_i_state_id', 'fk_i_country_id', 'fk_i_zip_id', 'i_status', 'fk_i_requested_by', 'i_request_renewed_count'], 'integer'],
            [['s_name', 's_address', 's_address1', 's_email', 's_mobile', 's_ip_address', 'dt_date_created', 'dt_request_complete_date', 'dt_request_renew_date'], 'safe'],
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
        $query = Lead::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'pk_i_id'=>SORT_DESC,
                ],
            ],
        ]);
        $query->joinWith('city');
        $this->load($params);

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }

        // grid filtering conditions
        $query->andFilterWhere([
            'pk_i_id' => $this->pk_i_id,
            'fk_i_sub_category_id' => $this->fk_i_sub_category_id,
            // 'fk_i_city_id' => $this->fk_i_city_id,
            'fk_i_state_id' => $this->fk_i_state_id,
            'fk_i_country_id' => $this->fk_i_country_id,
            'fk_i_zip_id' => $this->fk_i_zip_id,
            'i_status' => $this->i_status,
            'fk_i_requested_by' => $this->fk_i_requested_by,
            'dt_date_created' => $this->dt_date_created,
            'dt_request_complete_date' => $this->dt_request_complete_date,
            'i_request_renewed_count' => $this->i_request_renewed_count,
            'dt_request_renew_date' => $this->dt_request_renew_date,
        ]);

        $query->andFilterWhere(['like', 's_name', $this->s_name])
            ->andFilterWhere(['like', 's_address', $this->s_address])
            ->andFilterWhere(['like', 's_address1', $this->s_address1])
            ->andFilterWhere(['like', 's_email', $this->s_email])
            ->andFilterWhere(['like', 's_mobile', $this->s_mobile])
            ->andFilterWhere(['like', 's_ip_address', $this->s_ip_address])
            ->andFilterWhere(['like', 'city.name', $this->fk_i_city_id]);
             $query->andWhere('lead.dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
