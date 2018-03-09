<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "request_status".
 *
 * @property int $id
 * @property string $name Статус заявки
 *
 * @property Request[] $requests
 */
class RequestStatus extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'name' => Yii::t('models', 'Статус заявки'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RequstStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequstStatusQuery(get_called_class());
    }
}
