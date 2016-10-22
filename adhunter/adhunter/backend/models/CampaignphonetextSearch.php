<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Campaignphonetext;

/**
 * CampaignphonetextSearch represents the model behind the search form about `backend\models\Campaignphonetext`.
 */
class CampaignphonetextSearch extends Campaignphonetext
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_template_id'], 'integer'],
            [['s_name', 's_user_query', 's_company_query', 's_body', 's_status', 'dt_deleted_at'], 'safe'],
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
        $query = Campaignphonetext::find();

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
            'fk_i_template_id' => $this->fk_i_template_id,
            'dt_deleted_at' => $this->dt_deleted_at,
        ]);

        $query->andFilterWhere(['like', 's_name', $this->s_name])
            ->andFilterWhere(['like', 's_user_query', $this->s_user_query])
            ->andFilterWhere(['like', 's_company_query', $this->s_company_query])
            ->andFilterWhere(['like', 's_body', $this->s_body])
            ->andFilterWhere(['like', 's_status', $this->s_status]);

        return $dataProvider;
    }
}
