<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Question;
use backend\models\Subcategory;
use backend\models\QuestionType;

/**
 * QuestionSearch represents the model behind the search form about `backend\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['question_text', 'created_at', 'updated_at', 'dt_deleted_at', 'question_type_id'], 'safe'],
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
        $query = Question::find();

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
        
//        $query->joinWith('question_category'); //Added by Aninda 6/8
       $query->joinWith('subcategory'); //Added by Aninda 6/8
       $query->joinWith('question_type'); //Added by Aninda 6/8

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'question_type_id' => $this->question_type_id,
            // 'dt_deleted_at' => $this->dt_deleted_at,
        ]);

        $query->andFilterWhere(['like', 'question_text', $this->question_text])
//         	  ->andFilterWhere(['like', 'subcategory.id', $this->question_category.subcategory.id]); //Added by Aninda 6/7
        		->andFilterWhere(['like', 'question_type.id', $this->question_type_id])
                ->andFilterWhere(['like', 'created_at', $this->created_at])
                ->andFilterWhere(['like', 'updated_at', $this->updated_at]); //Added by Aninda 6/7
        $query->andWhere('question.dt_deleted_at IS NULL');
        return $dataProvider;
    }
}
