<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Company;
use backend\models\Zipcode;

/**
 * CompanySearch represents the model behind the search form about `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'state_id', 'country_id', 'zip_id', 'mobile_alert_flag', 'closed_company_flag', 'user_id', 'active_company_flag'], 'integer'],
            [['name', 'address', 'address1', 'about', 'year_founded', 'website', 'profile_pic', 'banner', 'phone', 'mobile', 'email', 'company_claimed', 'invoice_logo'], 'safe'],
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
        $query = Company::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->joinWith('city');
        $query->joinWith('zip');

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($this->zip_id))
            $query->andFilterWhere([
                'zip_id' => Zipcode::find()->select('id')->where('zip ='.$this->zip_id)->One(),
            ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'city_id' => $this->city_id,
            'state_id' => $this->state_id,
            'country_id' => $this->country_id,
            // 'zip_id' => $this->zip_id,
            'year_founded' => $this->year_founded,
            'mobile_alert_flag' => $this->mobile_alert_flag,
            'closed_company_flag' => $this->closed_company_flag,
            'user_id' => $this->user_id,
            'active_company_flag' => $this->active_company_flag,
        ]);

        $query->andFilterWhere(['like', 'company.name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'profile_pic', $this->profile_pic])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'company_claimed', $this->company_claimed])
            ->andFilterWhere(['like', 'invoice_logo', $this->invoice_logo])
            ->andFilterWhere(['like', 'city.name', $this->city_id])
            ->andFilterWhere(['like', 'zipcode.zip', $this->zip_id]); 

            $query->andWhere('company.dt_deleted_at IS NULL');

            return $dataProvider;
    }
}
