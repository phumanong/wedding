<?php
namespace system\models\system;
use Yii;

class MaterialSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'material';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'note' => 'Note',
            'material_Type_id' => 'Material  Type ID',
        ];
    }

    public function getFoodMaterials()
    {
        return $this->hasMany(FoodMaterial::className(), ['material_id' => 'id']);
    }

    public function getFoods()
    {
        return $this->hasMany(Food::className(), ['id' => 'food_id'])->viaTable('food_material', ['material_id' => 'id']);
    }

    public function getInputDetails()
    {
        return $this->hasMany(InputDetail::className(), ['material_id' => 'id']);
    }

    public function getMaterialType()
    {
        return $this->hasOne(MaterialType::className(), ['id' => 'material_Type_id']);
    }

    public function getMaterialInventories()
    {
        return $this->hasMany(MaterialInventory::className(), ['material_id' => 'id']);
    }

    public function getOutputInventoryDetails()
    {
        return $this->hasMany(OutputInventoryDetail::className(), ['material_id' => 'id']);
    }
}
