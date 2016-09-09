<?php
namespace system\models\system;
use Yii;

class CustomerSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gender' => 'Gender',
            'name' => 'Name',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'address' => 'Address',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
