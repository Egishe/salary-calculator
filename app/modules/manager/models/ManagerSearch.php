<?php

namespace app\modules\manager\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Manager;
use yii\db\Expression;

/**
 * ManagerSearch represents the model behind the search form of `common\models\Manager`.
 */
class ManagerSearch extends Manager
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['first_name', 'last_name', 'patronymic', 'updated_at', 'created_at', 'deleted'], 'safe'],
            [['salary', 'count_request'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Manager::find()
            ->alias('m')
            ->select([
                'm.*',
                new Expression('COUNT(r.id) AS count_request'),
                new Expression('DATE_FORMAT(r.created_at, "%Y-%m") AS month')

            ])
            ->joinWith('requests r')
            ->groupBy(['m.id', 'month'])
            ->andWhere(['deleted' => false]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'salary' => $this->salary,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'deleted', $this->deleted]);

        return $dataProvider;
    }
}
