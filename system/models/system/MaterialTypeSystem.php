<?php
namespace system\models\system;
use Yii;

class MaterialTypeSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'material_type';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }

    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['material_Type_id' => 'id']);
    }
}
