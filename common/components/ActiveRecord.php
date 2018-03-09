<?php

namespace common\components;


use yii\db\ActiveRecord as YiiActiveRecord;
use Exception;

class ActiveRecord extends YiiActiveRecord
{
    /**
     * @throws Exception
     */
    public function softDelete()
    {
        if (!$this->hasProperty('deleted')) {
            throw new Exception('Method is unavailable.');
        }

        $this->setAttribute('deleted', 1);
        return $this->save();
    }

    /**
     * @throws Exception
     */
    public function softRestore()
    {
        if (!$this->hasproperty('deleted')) {
            throw new Exception('Method is unavailable.');
        } elseif ($this->hasproperty('deleted') && $this->getAttribute('deleted') == 0) {
            throw new Exception('This data was not deleted so you can`t restore it.');
        }

        $this->setAttribute('deleted', 0);
        return $this->save();
    }
}