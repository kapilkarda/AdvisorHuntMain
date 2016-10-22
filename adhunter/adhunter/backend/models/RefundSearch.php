<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Refund;

/**
 * RefundSearch represents the model behind the search form about `backend\models\Refund`.
 */
class RefundSearch extends Refund
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_project_id', 'fk_i_pro_id', 'fk_i_bid_id', 'i_refund_status'], 'integer'],
            [['s_description', 'dt_date', 's_refund_processed_by'], 'safe'],
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
        $query = Refund::find();

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
            'fk_i_project_id' => $this->fk_i_project_id,
            'fk_i_pro_id' => $this->fk_i_pro_id,
            'fk_i_bid_id' => $this->fk_i_bid_id,
            'dt_date' => $this->dt_date,
            'i_refund_status' => $this->i_refund_status,
        ]);

        $query->andFilterWhere(['like', 's_description', $this->s_description])
            ->andFilterWhere(['like', 's_refund_processed_by', $this->s_refund_processed_by]);
           $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
