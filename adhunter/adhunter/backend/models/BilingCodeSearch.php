<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BilingCode;

/**
 * BilingCodeSearch represents the model behind the search form about `backend\models\BilingCode`.
 */
class BilingCodeSearch extends BilingCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'i_biling_Code', 'i_token_count_slab1_id', 'i_token_count_slab2_id', 'i_token_count_slab3_id'], 'integer'],
            [['s_billing_code_details', 'dt_billing_code_start_date', 'dt_billing_code_end_date', 's_discounts'], 'safe'],
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
        $query = BilingCode::find();

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
            'i_biling_Code' => $this->i_biling_Code,
            'i_token_count_slab1_id' => $this->i_token_count_slab1_id,
            'i_token_count_slab2_id' => $this->i_token_count_slab2_id,
            'i_token_count_slab3_id' => $this->i_token_count_slab3_id,
        ]);

        $query->andFilterWhere(['like', 's_billing_code_details', $this->s_billing_code_details])
            ->andFilterWhere(['like', 's_discounts', $this->s_discounts])
            ->andFilterWhere(['like', 'dt_billing_code_start_date', $this->dt_billing_code_start_date])
            ->andFilterWhere(['like', 'dt_billing_code_end_date', $this->dt_billing_code_end_date]);
             $query->andWhere('dt_deleted_at IS NULL');

        return $dataProvider;
    }
}
