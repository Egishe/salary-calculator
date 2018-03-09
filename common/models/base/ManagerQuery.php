<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[Manager]].
 *
 * @see Manager
 */
class ManagerQuery extends \common\components\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Manager[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Manager|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
