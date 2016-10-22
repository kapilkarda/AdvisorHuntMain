<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PromoCode;

/**
 * PromoCodeSearch represents the model behind the search form about `backend\models\PromoCode`.
 */
class PromoCodeSearch extends PromoCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'i_no_of_tokens'], 'integer'],
            [['i_code', 'dt_start_date', 'dt_end_date', 'dt_created_at', 'dt_deleted_at'], 'safe'],
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
        $query = PromoCode::find();

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
            'i_no_of_tokens' => $this->i_no_of_tokens,
            // 'dt_start_date' => $this->dt_start_date,
            'dt_end_date' => $this->dt_end_date,
            'dt_created_at' => $this->dt_created_at,
        ]);

        $query->andFilterWhere(['like', 'dt_start_date', $this->dt_start_date]);
        $query->andFilterWhere(['like', 'i_code', $this->i_code]);
        $query->andWhere('dt_deleted_at IS NULL');

        return $dataProvider;
    }
}
