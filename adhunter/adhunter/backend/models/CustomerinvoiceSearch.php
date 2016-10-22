<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CustomerInvoice;

/**
 * CustomerinvoiceSearch represents the model behind the search form about `backend\models\customerinvoice`.
 */
class CustomerinvoiceSearch extends customerinvoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_company_id', 'fk_i_user_id', 'i_invoice_tot_amt'], 'integer'],
            [['s_memo', 'dt_invoice_date', 'dt_paid_date'], 'safe'],
            [['f_invoice_paid_amt', 'f_invoice_due_amt'], 'number'],
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
        $query = customerinvoice::find();

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
            'fk_i_user_id' => $this->fk_i_user_id,
            'i_invoice_tot_amt' => $this->i_invoice_tot_amt,
            'f_invoice_paid_amt' => $this->f_invoice_paid_amt,
            'f_invoice_due_amt' => $this->f_invoice_due_amt,
            'dt_paid_date' => $this->dt_paid_date,
        ]);

        $query->andFilterWhere(['like', 's_memo', $this->s_memo])
            ->andFilterWhere(['like', 'dt_invoice_date', $this->dt_invoice_date]);

        return $dataProvider;
    }
}
