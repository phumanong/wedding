<?php
namespace system\models;
use Yii;
use system\models\system\CustomerSystem;

class Customer extends CustomerSystem
{
	public function getOrder()
    {
        return $this->hasOne(Order::className(), ['customer_id' => 'id']);
    }
}
