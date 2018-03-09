<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $manager_id Менеджер
 * @property int $status_id Статус
 * @property string $description Описание
 * @property string $updated_at Обновлено в
 * @property string $created_at Создано в
 *
 * @property Manager $manager
 * @property RequestStatus $status
 */
class Request extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id'], 'integer'],
            [['description'], 'string'],
            [['updated_at', 'created_at'], 'safe'],
            [['status_id'], 'string', 'max' => 3],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['manager_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'manager_id' => Yii::t('models', 'Менеджер'),
            'status_id' => Yii::t('models', 'Статус'),
            'description' => Yii::t('models', 'Описание'),
            'updated_at' => Yii::t('models', 'Обновлено в'),
            'created_at' => Yii::t('models', 'Создано в'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(RequestStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @inheritdoc
     * @return RequstQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequstQuery(get_called_class());
    }
}
