<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyServices;

/**
 * CompanyServicesSearch represents the model behind the search form about `backend\models\CompanyServices`.
 */
class CompanyServicesSearch extends CompanyServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_company_id', 'fk_i_service_id'], 'integer'],
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
        $query = CompanyServices::find();

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
            'fk_i_service_id' => $this->fk_i_service_id,
        ]);

        return $dataProvider;
    }
}
