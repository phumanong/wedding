<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property integer $id
 * @property string $name
 * @property integer $start_hour
 * @property integer $end_hour
 * @property integer $is_delete
 *
 * @property Employee[] $employees
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_hour', 'end_hour', 'is_delete'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start_hour' => 'Start Hour',
            'end_hour' => 'End Hour',
            'is_delete' => 'Is Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['session_id' => 'id']);
    }
}
