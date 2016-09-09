<?php
namespace system\models\system;
use Yii;

class StandardMaterialSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'standard_material';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material_Inventory_id' => 'Material  Inventory ID',
            'standard_price' => 'Standard Price',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'standard_id' => 'Standard ID',
        ];
    }

    public function getMaterialInventory()
    {
        return $this->hasOne(MaterialInventory::className(), ['id' => 'material_Inventory_id']);
    }

    public function getStandard()
    {
        return $this->hasOne(Standard::className(), ['id' => 'standard_id']);
    }
}
