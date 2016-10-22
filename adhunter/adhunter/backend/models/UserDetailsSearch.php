<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserDetails;
use backend\models\Zipcode;
/**
 * UserDetailsSearch represents the model behind the search form about `backend\models\UserDetails`.
 */
class UserDetailsSearch extends UserDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'mobile', 'city_id', 'state_id', 'zip_id', 'country_id', 'user_id'], 'integer'],
            [['first_name', 'last_name', 'profile_pic', 'email', 'address', 'address1', 'dynamic1', 'dynamic2'], 'safe'],
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
        $query = UserDetails::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->joinWith('city');
        $query->joinWith('zip');

        $this->load($params);

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }
           
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'phone' => $this->phone,
            // 'city_id' => $this->city_id,
            'state_id' => $this->state_id,
            // 'zip_id' => $this->zip_id,
            'country_id' => $this->country_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'profile_pic', $this->profile_pic])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'dynamic1', $this->dynamic1])
            ->andFilterWhere(['like', 'dynamic2', $this->dynamic2])
            ->andFilterWhere(['like', 'city.name', $this->city_id])
            ->andFilterWhere(['like', 'zipcode.zip', $this->zip_id]); 

        $query->andWhere('user_details.dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
