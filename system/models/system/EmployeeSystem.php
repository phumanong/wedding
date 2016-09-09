<?php
namespace system\models\system;
use Yii;

class EmployeeSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'employee';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'birthday' => 'Birthday',
            'email' => 'Email',
            'cmnd' => 'Cmnd',
            'address' => 'Address',
            'gender' => 'Gender',
            'education' => 'Education',
            'images' => 'Images',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
            'office_id' => 'Office ID',
            'salary' => 'Salary',
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    public function getOffice()
    {
        return $this->hasOne(Office::className(), ['id' => 'office_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStandardEmployees()
    {
        return $this->hasMany(StandardEmployee::className(), ['employee_id' => 'id']);
    }
}
