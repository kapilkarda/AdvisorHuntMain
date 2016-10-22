<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $question_type_id
 * @property string $question_text
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Answer[] $answers
 */
class Question extends \yii\db\ActiveRecord
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
    public function getQuestion_type()
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
        // return count($question);

         if(count($question->subcategory) != 0){
         			$tmp = array_keys($question->subcategory); // Added by Aninda on 5/29/2016
                  	$last_key = end($tmp);
	        foreach ($question->subcategory as $key => $value) {
	             if ($key == $last_key) {
	                $category .= $value['name'];
	            } else {
	                $category .= $value['name'].", ";
	            }
	        }
         }        
        return $category;
    }

    // Fetch answers of a question
     public function getAnswersByQuestion($id){
        $question = $this::find()->with('answers')->where(['id' => $id])->one();
        $answers = '';
        if(count($question->answers) != 0){
        	$tmp = array_keys($question->subcategory); // Added by Aninda on 5/29/2016
	        $last_key = end($tmp);
	        foreach ($question->answers as $key => $value) {
	            if($value['dependent_question_id'] == null)
	                $answers .= $value['answer_text'].' <a href='. Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/create&option_id='.$value['id'].'>Add Dependent Question</a> <br>';
	            else
	                $answers .= $value['answer_text'].' <a href='. Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/view&id='.$value['dependent_question_id'].'>See Dependent Question </a>, <a href='.Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/detach&option_id='.$value['id'].'> Detach Question</a><br>';
	        }
	    }
        return $answers;
    }
}
