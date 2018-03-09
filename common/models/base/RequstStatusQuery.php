<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[RequestStatus]].
 *
 * @see RequestStatus
 */
class RequstStatusQuery extends \common\components\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RequestStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RequestStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
