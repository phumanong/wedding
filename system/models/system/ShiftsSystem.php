<?php
namespace system\models\system;
use Yii;

class ShiftsSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'shifts';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start_hour' => 'Start Hour',
            'end_hour' => 'End Hour',
        ];
    }

    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['Shifts_id' => 'id']);
    }
}
