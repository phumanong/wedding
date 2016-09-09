<?php
namespace system\models\system;
use Yii;

class UserSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'password' => 'Password',
            'status' => 'Status',
            'is_admin' => 'Is Admin',
            'is_active' => 'Is Active',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['user_id' => 'id']);
    }

    public function getMaterialInventories()
    {
        return $this->hasMany(MaterialInventory::className(), ['user_id' => 'id']);
    }
}
