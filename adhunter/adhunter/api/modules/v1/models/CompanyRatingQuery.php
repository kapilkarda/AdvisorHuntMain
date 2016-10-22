<?php

namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the ActiveQuery class for [[CompanyRating]].
 *
 * @see CompanyRating
 */
class CompanyRatingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CompanyRating[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CompanyRating|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
