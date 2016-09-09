<?php
namespace system\models\system;
use Yii;

class OutputInventorySystem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'output_inventory';
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_at' => 'Create At',
            'description' => 'Description',
        ];
    }

    public function getOutputInventoryDetails()
    {
        return $this->hasMany(OutputInventoryDetail::className(), ['output_inventory_id' => 'id']);
    }
}
