<?php

namespace common\models;

use Yii;

class Manager extends \common\models\base\Manager
{
    public $count_request;
    public $month;

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'count_request' => Yii::t('models', 'Всего заявок'),
            'month' => Yii::t('models', 'Месяц')
        ]);
    }

    /**
     * @return float|int
     */
    public function getSumSalary()
    {
        $salary = $this->salary;
        $countRequest = $this->count_request;

        if (!$countRequest) {
            return $salary;
        }

        foreach ($this->getBonuses() as $key => $bonus) {
            if ($countRequest > $key) {
                $diff = $countRequest - $key;
                $salary += $diff * $bonus;
                $countRequest -= $diff;
            }
        }

        return $salary;
    }

    /**
     * @return array
     */
    public function getBonuses()
    {
        /*
         * todo: Сделать модуль для управления бонусами и брать их из соответствующей модели.
         * Настройка может быть как для роли, так и для конкретного менеджера.
         * А сам метод позже должен возвращать уже начисленные бонусы.
         * Расчетов на лету быть не должно, ибо настройки могут поменяться в середине месяца,
         * а менеджеру начислят за предыдущие звонки по новой системе бонусов.
         * Плюс, это поможет улучшить производительность.
         */
        return [
            300 => 300,
            200 => 0,
            100 => 200,
            0 => 100,
        ];
    }
}