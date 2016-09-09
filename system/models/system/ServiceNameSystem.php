<?php
namespace system\models\system;
use Yii;

class ServiceNameSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'service_name';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'note' => 'Note',
        ];
    }
}
