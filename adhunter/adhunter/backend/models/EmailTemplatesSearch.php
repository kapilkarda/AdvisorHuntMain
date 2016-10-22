<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EmailTemplates;

/**
 * EmailTemplatesSearch represents the model behind the search form about `backend\models\EmailTemplates`.
 */
class EmailTemplatesSearch extends EmailTemplates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id'], 'integer'],
            [['s_name', 's_title', 's_email_template'], 'safe'],
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
        $query = EmailTemplates::find();

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
        ]);

        $query->andFilterWhere(['like', 's_name', $this->s_name])
            ->andFilterWhere(['like', 's_title', $this->s_title])
            ->andFilterWhere(['like', 's_email_template', $this->s_email_template]);

        return $dataProvider;
    }
}
