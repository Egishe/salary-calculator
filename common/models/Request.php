<?php

namespace common\models;


use yii\db\Expression;

class Request extends \common\models\base\Request
{
    public function getBonus()
    {
        $countPrev = static::find()
            ->where([
                'and',
                ['manager_id' => $this->manager_id],
                ['<', 'created_at', $this->created_at],
                ['>', 'created_at', new Expression('DATE_FORMAT("' . $this->created_at . '", "%Y-%m-01")')],
            ])->count();

        foreach ($this->manager->getBonuses() as $key => $bonus) {
            if ($countPrev >= $key) {
                return $bonus;
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['id' => 'manager_id']);
    }
}