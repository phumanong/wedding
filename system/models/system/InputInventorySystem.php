<?php
namespace system\models\system;
use Yii;

class InputInventorySystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'input_inventory';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_at' => 'Create At',
            'description' => 'Description',
        ];
    }

    public function getInputDetails()
    {
        return $this->hasMany(InputDetail::className(), ['input_inventory_id' => 'id']);
    }
}
