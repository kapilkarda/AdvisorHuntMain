<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Payment;

/**
 * PaymentSearch represents the model behind the search form about `backend\models\payment`.
 */
class PaymentSearch extends payment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_purchase_order_id', 'fk_i_invoice_id', 'fk_i_user_id', 'b_payments_successful'], 'integer'],
            [['s_payment_type', 's_payment_ip', 'dt_created_at'], 'safe'],
            [['f_amount'], 'number'],
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
        $query = payment::find();

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
            'fk_i_purchase_order_id' => $this->fk_i_purchase_order_id,
            'fk_i_invoice_id' => $this->fk_i_invoice_id,
            'fk_i_user_id' => $this->fk_i_user_id,
            'f_amount' => $this->f_amount,
            'b_payments_successful' => $this->b_payments_successful,
            'dt_created_at' => $this->dt_created_at,
        ]);

        $query->andFilterWhere(['like', 's_payment_type', $this->s_payment_type])
            ->andFilterWhere(['like', 's_payment_ip', $this->s_payment_ip]);
         $query->andWhere('dt_deleted_at IS NULL');

        return $dataProvider;
    }
}
