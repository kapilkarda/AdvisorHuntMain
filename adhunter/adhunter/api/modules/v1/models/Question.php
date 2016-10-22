<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;


use Yii;

class Question extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_type_id', 'question_text'], 'required'],
            [['question_type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['question_text'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_type_id' => 'Question Type ',
            'question_text' => 'Question Text',
        ];
    }

    // This is relation to Question type
    public function getQuestiontype()
    {
        return $this->hasOne(QuestionType::className(), ['id' => 'question_type_id']);
    }

    // This is relation to answer
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    // This is relation to getSubcategory
    public function getSubcategory() {
        return $this->hasMany(Subcategory::className(), ['id' => 'subcategory_id'])
          ->viaTable('question_category', ['question_id' => 'id']);
    }

    // Fetch sub categroy of a question
    public function getCategorysByQuestion($id){
        $question = $this::find()->with('subcategory')->where(['id' => $id])->one();
        $category = '';
        $last_key = end(array_keys($question->subcategory));
        foreach ($question->subcategory as $key => $value) {
             if ($key == $last_key) {
                $category .= $value['name'];
            } else {
                $category .= $value['name'].", ";
            }
        }
        return $category;
    }

    // Fetch answers of a question
     public function getAnswersByQuestion($id){
        $question = $this::find()->with('answers')->where(['id' => $id])->one();
        $answers = '';
        $last_key = end(array_keys($question->answers));
        foreach ($question->answers as $key => $value) {
            if($value['dependent_question_id'] == null)
                $answers .= $value['answer_text'].' <a href='. Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/create&option_id='.$value['id'].'>Add Dependent Question</a> <br>';
            else
                $answers .= $value['answer_text'].' <a href='. Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/view&id='.$value['dependent_question_id'].'>See Dependent Question </a>, <a href='.Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/detach&option_id='.$value['id'].'> Detach Question</a><br>';
        }
        return $answers;
    }
}
