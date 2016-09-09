<?php
namespace system\models\system;
use Yii;

class HallSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'hall';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'max_table' => 'Max Table',
            'min_table' => 'Min Table',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['hall_id' => 'id']);
    }
}
