<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PhoneTextTemplate;

/**
 * PhoneTextTemplateSearch represents the model behind the search form about `backend\models\PhoneTextTemplate`.
 */
class PhoneTextTemplateSearch extends PhoneTextTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'i_template_type'], 'integer'],
            [['s_name', 's_template', 'dt_created_date', 'dt_deleted_at'], 'safe'],
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
        $query = PhoneTextTemplate::find();

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
            'i_template_type' => $this->i_template_type,
            'dt_created_date' => $this->dt_created_date,
            'dt_deleted_at' => $this->dt_deleted_at,
        ]);

        $query->andFilterWhere(['like', 's_name', $this->s_name])
            ->andFilterWhere(['like', 's_template', $this->s_template]);

        return $dataProvider;
    }
}