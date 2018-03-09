<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property int $id
 * @property string $role Роль
 * @property string $first_name Имя
 * @property string $last_name Фамилия
 * @property string $patronymic Отчество
 * @property double $salary Оклад
 * @property string $updated_at Обновлено в
 * @property string $created_at Создано в
 * @property int $deleted Удален
 *
 * @property Request[] $requests
 */
class Manager extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['salary'], 'number'],
            [['updated_at', 'created_at'], 'safe'],
            [['role'], 'string', 'max' => 255],
            [['first_name', 'last_name', 'patronymic'], 'string', 'max' => 100],
            [['deleted'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'role' => Yii::t('models', 'Роль'),
            'first_name' => Yii::t('models', 'Имя'),
            'last_name' => Yii::t('models', 'Фамилия'),
            'patronymic' => Yii::t('models', 'Отчество'),
            'salary' => Yii::t('models', 'Оклад'),
            'updated_at' => Yii::t('models', 'Обновлено в'),
            'created_at' => Yii::t('models', 'Создано в'),
            'deleted' => Yii::t('models', 'Удален'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['manager_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ManagerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ManagerQuery(get_called_class());
    }
}
