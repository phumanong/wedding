<?php
namespace system\models\system;
use Yii;

class OrderSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_code' => 'Number Code',
            'name' => 'Name',
            'customer_id' => 'Customer ID',
            'hall_id' => 'Hall ID',
            'service_Type_id' => 'Service  Type ID',
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getHall()
    {
        return $this->hasOne(Hall::className(), ['id' => 'hall_id']);
    }

    public function getServiceType()
    {
        return $this->hasOne(ServiceType::className(), ['id' => 'service_Type_id']);
    }
}
