<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProImage;

/**
 * ProimageSearch represents the model behind the search form about `backend\models\Proimage`.
 */
class ProimageSearch extends Proimage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_pro_user_id', 'fk_i_project_id', 'b_status'], 'integer'],
            [['s_image_type', 's_image', 's_image_alt_details', 'd_upload_date', 'dt_deleted_at'], 'safe'],
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
        $query = Proimage::find();

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
            'fk_i_pro_user_id' => $this->fk_i_pro_user_id,
            'fk_i_project_id' => $this->fk_i_project_id,
            'b_status' => $this->b_status,
            'dt_deleted_at' => $this->dt_deleted_at,
        ]);

        $query->andFilterWhere(['like', 's_image_type', $this->s_image_type])
            ->andFilterWhere(['like', 's_image', $this->s_image])
            ->andFilterWhere(['like', 's_image_alt_details', $this->s_image_alt_details])
            ->andFilterWhere(['like', 'd_upload_date', $this->d_upload_date]);

        return $dataProvider;
    }
}
