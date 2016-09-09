<?php
namespace system\models\system;
use Yii;

class GroupSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'group';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'number' => 'Number',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'Shifts_id' => 'Shifts ID',
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['group_id' => 'id']);
    }

    public function getShifts()
    {
        return $this->hasOne(Shifts::className(), ['id' => 'Shifts_id']);
    }
}
