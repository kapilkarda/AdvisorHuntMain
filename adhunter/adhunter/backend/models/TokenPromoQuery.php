<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TokenPromo]].
 *
 * @see TokenPromo
 */
class TokenPromoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TokenPromo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TokenPromo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
