<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CompanyReviewComment]].
 *
 * @see CompanyReviewComment
 */
class CompanyReviewCommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CompanyReviewComment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyReviewComment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
