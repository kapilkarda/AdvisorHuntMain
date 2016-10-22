<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProjectImage;

/**
 * ProjectImageSearch represents the model behind the search form about `backend\models\projectimage`.
 */
class ProjectImageSearch extends ProjectImage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_project_id', 'fk_uploaded_by_id', 'b_status'], 'integer'],
            [['s_image_alt_details', 's_image', 'd_upload_date', 'dt_deleted_at'], 'safe'],
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
        $query = projectimage::find();

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
            'fk_i_project_id' => $this->fk_i_project_id,
            'fk_uploaded_by_id' => $this->fk_uploaded_by_id,
            'b_status' => $this->b_status,
        ]);

        $query->andFilterWhere(['like', 's_image_alt_details', $this->s_image_alt_details])
            ->andFilterWhere(['like', 's_image', $this->s_image])
            ->andFilterWhere(['like', 'd_upload_date', $this->d_upload_date]);

        $query->andWhere('dt_deleted_at IS NULL');

        return $dataProvider;
    }
}
