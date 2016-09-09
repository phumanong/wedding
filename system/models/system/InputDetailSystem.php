<?php
namespace system\models\system;
use Yii;

class InputDetailSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'input_detail';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
            'create_at' => 'Create At',
            'quantity' => 'Quantity',
            'material_id' => 'Material ID',
            'input_inventory_id' => 'Input Inventory ID',
        ];
    }

    public function getInputInventory()
    {
        return $this->hasOne(InputInventory::className(), ['id' => 'input_inventory_id']);
    }

    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }
}
