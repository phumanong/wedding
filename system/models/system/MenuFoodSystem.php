<?php
namespace system\models\system;
use Yii;

class MenuFoodSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'menu_food';
    }
    public function attributeLabels()
    {
        return [
            'menu_group_id' => 'Menu Group ID',
            'food_id' => 'Food ID',
        ];
    }

    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    public function getMenuGroup()
    {
        return $this->hasOne(MenuGroup::className(), ['id' => 'menu_group_id']);
    }
}
