<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BackgroundCheck;

/**
 * BackgroundCheckSearch represents the model behind the search form about `backend\models\BackgroundCheck`.
 */
class BackgroundCheckSearch extends BackgroundCheck
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_company_id', 'i_bg_check_status'], 'integer'],
            [['dt_bg_check_date', 's_bg_check_agency', 's_bg_check_report_image', 's_bg_check_comments', 's_bg_check_validity'], 'safe'],
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
        $query = BackgroundCheck::find();

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
            'dt_bg_check_date' => $this->dt_bg_check_date,
            'i_bg_check_status' => $this->i_bg_check_status,
        ]);

        $query->andFilterWhere(['like', 's_bg_check_agency', $this->s_bg_check_agency])
            ->andFilterWhere(['like', 's_bg_check_report_image', $this->s_bg_check_report_image])
            ->andFilterWhere(['like', 's_bg_check_comments', $this->s_bg_check_comments])
            ->andFilterWhere(['like', 's_bg_check_validity', $this->s_bg_check_validity]);
              $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
