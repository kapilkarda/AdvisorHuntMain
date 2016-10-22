<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `backend\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_requested_by', 'i_type', 'fk_i_zip_id', 'fk_i_company_id'], 'integer'],
            [['s_name', 's_duration', 's_description', 's_address', 'dt_created_at', 'dt_deleted_at'], 'safe'],
            [['f_cost'], 'number'],
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
        $query = Project::find();
        // add conditions that should always apply here
  
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'pk_i_id'=>SORT_DESC,
                ],
            ],
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
            'fk_i_requested_by' => $this->fk_i_requested_by,
            'i_type' => $this->i_type,
            'f_cost' => $this->f_cost,
            'fk_i_zip_id' => $this->fk_i_zip_id,
            'fk_i_company_id' => $this->fk_i_company_id,
            'dt_created_at' => $this->dt_created_at,
        ]);

        $query->andFilterWhere(['like', 's_name', $this->s_name])
            ->andFilterWhere(['like', 's_duration', $this->s_duration])
            ->andFilterWhere(['like', 's_description', $this->s_description])
            ->andFilterWhere(['like', 's_address', $this->s_address]);     
             $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
