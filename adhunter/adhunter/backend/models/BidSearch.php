<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bid;

/**
 * BidSearch represents the model behind the search form about `backend\models\Bid`.
 */
class BidSearch extends Bid
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_lead_id', 'fk_i_user_id', 'fk_i_token_used_id', 'i_status'], 'integer'],
            [['s_ip_address'], 'safe'],
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
        $query = Bid::find();

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
            'fk_i_lead_id' => $this->fk_i_lead_id,
            'fk_i_user_id' => $this->fk_i_user_id,
            'fk_i_token_used_id' => $this->fk_i_token_used_id,
            'i_status' => $this->i_status,
        ]);

        $query->andFilterWhere(['like', 's_ip_address', $this->s_ip_address]);

        return $dataProvider;
    }
}
