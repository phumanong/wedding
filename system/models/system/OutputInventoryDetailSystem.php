<?php
namespace system\models\system;
use Yii;

class OutputInventoryDetailSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'output_inventory_detail';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_at' => 'Create At',
            'quantity' => 'Quantity',
            'material_id' => 'Material ID',
            'output_inventory_id' => 'Output Inventory ID',
        ];
    }

    public function getOutputInventory()
    {
        return $this->hasOne(OutputInventory::className(), ['id' => 'output_inventory_id']);
    }

    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }
}
