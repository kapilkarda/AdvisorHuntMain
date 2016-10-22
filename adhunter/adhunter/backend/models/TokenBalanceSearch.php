<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TokenBalance;

/**
 * TokenBalanceSearch represents the model behind the search form about `backend\models\TokenBalance`.
 */
class TokenBalanceSearch extends TokenBalance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_user_id', 'i_prev_balance', 'i_current_balance'], 'integer'],
            [['dt_last_purchase_date', 'dt_last_used_date'], 'safe'],
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
        $query = TokenBalance::find();

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
            'fk_i_user_id' => $this->fk_i_user_id,
            'i_prev_balance' => $this->i_prev_balance,
            'i_current_balance' => $this->i_current_balance,
        ]);
         $query->andFilterWhere(['like', 'dt_last_used_date', $this->dt_last_used_date])
                ->andFilterWhere(['like', 'dt_last_purchase_date', $this->dt_last_purchase_date]);
         $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
