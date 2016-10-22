<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

class Answer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id'], 'required'],
            [['question_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['answer_text'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'answer_text' => 'Answer Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
