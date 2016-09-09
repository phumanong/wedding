<?php
namespace system\models\system;
use Yii;

class MaterialInventorySystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'material_inventory';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'import_date' => 'Import Date',
            'export_date' => 'Export Date',
            'user_id' => 'User ID',
            'material_id' => 'Material ID',
            'quantity' => 'Quantity',
            'description' => 'Description',
            'expired_date' => 'Expired Date',
        ];
    }

    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStandardMaterials()
    {
        return $this->hasMany(StandardMaterial::className(), ['material_Inventory_id' => 'id']);
    }
}
