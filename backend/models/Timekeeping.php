<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timekeeping".
 *
 * @property integer $id
 * @property integer $employee_id
 * @property integer $punishment
 * @property integer $shift
 * @property integer $special_shift
 *
 * @property Employee $employee
 */
class Timekeeping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timekeeping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id'], 'required'],
            [['employee_id', 'punishment', 'shift', 'special_shift'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'punishment' => 'Punishment',
            'shift' => 'Shift',
            'special_shift' => 'Special Shift',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
