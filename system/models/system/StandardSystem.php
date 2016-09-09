<?php
namespace system\models\system;
use Yii;

class StandardSystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'standard';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'number_of_standard' => 'Number Of Standard',
        ];
    }

    public function getStandardEmployees()
    {
        return $this->hasMany(StandardEmployee::className(), ['standard_id' => 'id']);
    }

    public function getStandardMaterials()
    {
        return $this->hasMany(StandardMaterial::className(), ['standard_id' => 'id']);
    }
}
