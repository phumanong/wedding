<?php
namespace system\models\system;
use Yii;

class FoodMaterialSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'food_material';
    }
    public function attributeLabels()
    {
        return [
            'food_id' => 'Food ID',
            'material_id' => 'Material ID',
        ];
    }

    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    public function getMaterial()
    {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }
}
