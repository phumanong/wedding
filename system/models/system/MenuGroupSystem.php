<?php
namespace system\models\system;
use Yii;

class MenuGroupSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'menu_group';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getMenuFoods()
    {
        return $this->hasMany(MenuFood::className(), ['menu_group_id' => 'id']);
    }
}
