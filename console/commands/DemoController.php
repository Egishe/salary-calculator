<?php

namespace console\commands;


use common\models\Manager;
use common\models\Request;
use console\components\Controller;
use Yii;
use yii\db\Query;

class DemoController extends Controller
{
    public function actionGenerateData()
    {
        $this->createManagerWithRequest();
    }

    protected function createManagerWithRequest()
    {
        foreach ($this->getData() as $data) {
            $manager = new Manager($data['manager']);

            if (!$manager->save()) {
                continue;
            }

            foreach ($this->generateRequestData($manager->id, $data['request']) as $requestData) {
                (new Query())->createCommand()
                    ->batchInsert(
                        Request::tableName(),
                        ['manager_id', 'status_id', 'created_at', 'updated_at'],
                        $requestData
                    )->execute();
            }
        }
    }

    /**
     * @return array
     */
    protected function getData()
    {
        return [
            [
                'manager' => [
                    'first_name' => 'Хельга',
                    'last_name' => 'Браун',
                    'salary' => 20000
                ],
                'request' => [10, 40, 40, 30, 10, 0, 0, 10, 20, 30, 10, 20]
            ],
            [
                'manager' => [
                    'first_name' => 'Барак',
                    'last_name' => 'Обама',
                    'salary' => 30000
                ],
                'request' => [10, 20, 10,30, 10, 0, 0, 10]
            ],
            [
                'manager' => [
                    'first_name' => 'Денис',
                    'last_name' => 'Козлов',
                    'salary' => 40000
                ],
                'request' => [10, 10, 10, 30, 10, 0, 0, 10, 10, 30, 10, 20]
            ]
        ];
    }

    /**
     * @param int $managerId
     * @param array $counts
     * @return \Generator
     */
    protected function generateRequestData(int $managerId, array $counts) : \Generator
    {
        $date = '2015-01-01';

        foreach ($counts as $count) {
            if ($count > 0) {
                $request = [];

                for ($i = 0; $i < $count; $i++) {
                    $requestDate = $date . ' ' . rand(9, 18) . ':' . rand(0, 59);
                    $request[] = [
                        'manager_id' => $managerId,
                        'status_id' => 2,
                        'created_at' => $requestDate,
                        'updated_at' => $requestDate
                    ];
                }

                yield $request;
            }

            $date++;
        }
    }
}