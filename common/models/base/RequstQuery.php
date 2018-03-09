<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[Request]].
 *
 * @see Request
 */
class RequstQuery extends \common\components\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Request[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Request|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
