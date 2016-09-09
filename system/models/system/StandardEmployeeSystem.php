<?php
namespace system\models\system;
use Yii;

class StandardEmployeeSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'standard_employee';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'standard_salary' => 'Standard Salary',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'standard_id' => 'Standard ID',
        ];
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    public function getStandard()
    {
        return $this->hasOne(Standard::className(), ['id' => 'standard_id']);
    }
}
