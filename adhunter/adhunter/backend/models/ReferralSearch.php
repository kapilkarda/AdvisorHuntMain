<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Referral;

/**
 * ReferralSearch represents the model behind the search form about `backend\models\referral`.
 */
class ReferralSearch extends referral
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'i_referral_status', 'fk_i_requested_user_id', 'i_referral_rminder_count', 'fk_i_referral_billing_code'], 'integer'],
            [['s_referral_details', 's_referral_sent_to_name', 's_referral_sent_to_email', 's_referral_sent_to_mobile', 's_referral_sent_to_message', 'dt_referral_sent_date', 'dt_last_reminder_date'], 'safe'],
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
        $query = referral::find();

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
            'i_referral_status' => $this->i_referral_status,
            'fk_i_requested_user_id' => $this->fk_i_requested_user_id,
            'i_referral_rminder_count' => $this->i_referral_rminder_count,
            'dt_last_reminder_date' => $this->dt_last_reminder_date,
            'fk_i_referral_billing_code' => $this->fk_i_referral_billing_code,
        ]);

        $query->andFilterWhere(['like', 's_referral_details', $this->s_referral_details])
            ->andFilterWhere(['like', 's_referral_sent_to_name', $this->s_referral_sent_to_name])
            ->andFilterWhere(['like', 's_referral_sent_to_email', $this->s_referral_sent_to_email])
            ->andFilterWhere(['like', 'dt_referral_sent_date', $this->dt_referral_sent_date])
            ->andFilterWhere(['like', 's_referral_sent_to_mobile', $this->s_referral_sent_to_mobile])
            ->andFilterWhere(['like', 's_referral_sent_to_message', $this->s_referral_sent_to_message]);
            $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
