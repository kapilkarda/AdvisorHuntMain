<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyLicense;

/**
 * CompanyLicenseSearch represents the model behind the search form about `backend\models\CompanyLicense`.
 */
class CompanyLicenseSearch extends CompanyLicense
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_state_id', 'fk_i_company_id'], 'integer'],
            [['s_accreditation', 's_accreditation_hash', 's_license_details', 'dt_expiration'], 'safe'],
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
        $query = CompanyLicense::find();

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
            'fk_i_state_id' => $this->fk_i_state_id,
            'dt_expiration' => $this->dt_expiration,
            'fk_i_company_id' => $this->fk_i_company_id,
        ]);

        $query->andFilterWhere(['like', 's_accreditation', $this->s_accreditation])
            ->andFilterWhere(['like', 's_accreditation#', $this->s_accreditation_hash])
            ->andFilterWhere(['like', 's_license_details', $this->s_license_details]);
          $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
