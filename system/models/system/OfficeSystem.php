<?php
namespace system\models\system;
use Yii;

class OfficeSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'office';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['office_id' => 'id']);
    }
}
