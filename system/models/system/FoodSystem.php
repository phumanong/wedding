<?php
namespace system\models\system;
use Yii;

class FoodSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'food';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
        ];
    }

    public function getFoodMaterials()
    {
        return $this->hasMany(FoodMaterial::className(), ['food_id' => 'id']);
    }

    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['id' => 'material_id'])->viaTable('food_material', ['food_id' => 'id']);
    }

    public function getMenuFoods()
    {
        return $this->hasMany(MenuFood::className(), ['food_id' => 'id']);
    }
}
