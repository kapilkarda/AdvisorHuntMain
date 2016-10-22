<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyReviewComment;

/**
 * CompanyReviewCommentSearch represents the model behind the search form about `backend\models\CompanyReviewComment`.
 */
class CompanyReviewCommentSearch extends CompanyReviewComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_company_id','fk_i_project_id', 'i_status'], 'integer'],
            [['s_review_by', 's_review_comment', 'dt_review_date'], 'safe'],
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
        $query = CompanyReviewComment::find();

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
            'dt_review_date' => $this->dt_review_date,
            'fk_i_project_id' => $this->fk_i_project_id,
            'i_status' => $this->i_status,
        ]);

        $query->andFilterWhere(['like', 's_review_by', $this->s_review_by])
            ->andFilterWhere(['like', 's_review_comment', $this->s_review_comment]);
         $query->andWhere('dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
