<?php
namespace system\models\system;
use Yii;

class ServiceTypeSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'service_type';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['service_Type_id' => 'id']);
    }
}
