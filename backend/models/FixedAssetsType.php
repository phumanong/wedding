<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fixed_assets_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_delete
 * @property integer $is_active
 *
 * @property FixedAssets[] $fixedAssets
 */
class FixedAssetsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fixed_assets_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_delete', 'is_active'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFixedAssets()
    {
        return $this->hasMany(FixedAssets::className(), ['fixed_assets_type_id' => 'id']);
    }
}
