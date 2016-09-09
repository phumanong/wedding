<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fixed_assets".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property double $total
 * @property integer $number
 * @property integer $is_active
 * @property integer $is_delete
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $expiry_date
 * @property integer $fixed_assets_type_id
 * @property string $size
 * @property string $color
 * @property string $note
 * @property string $image
 *
 * @property FixedAssetsType $fixedAssetsType
 */
class FixedAssets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fixed_assets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'total'], 'number'],
            [['number', 'is_active', 'is_delete', 'create_date', 'update_date', 'expiry_date', 'fixed_assets_type_id'], 'integer'],
            [['fixed_assets_type_id'], 'required'],
            [['note'], 'string'],
            [['name', 'size'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 45],
            [['image'], 'string', 'max' => 250]
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
            'price' => 'Price',
            'total' => 'Total',
            'number' => 'Number',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'expiry_date' => 'Expiry Date',
            'fixed_assets_type_id' => 'Fixed Assets Type ID',
            'size' => 'Size',
            'color' => 'Color',
            'note' => 'Note',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFixedAssetsType()
    {
        return $this->hasOne(FixedAssetsType::className(), ['id' => 'fixed_assets_type_id']);
    }
}
