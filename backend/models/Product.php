<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $product_type_id
 * @property string $short_description
 * @property integer $user_create
 * @property integer $user_update
 * @property integer $is_delete
 * @property integer $is_active
 * @property double $price
 * @property double $sale
 * @property double $discount
 * @property string $image
 * @property integer $is_index
 * @property integer $is_home
 * @property string $website
 * @property double $lat
 * @property double $lng
 * @property integer $is_view
 * @property integer $is_display
 * @property double $rate
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $status
 * @property integer $start_date_sale
 * @property integer $end_date_sale
 *
 * @property Color[] $colors
 * @property Images[] $images
 * @property ProductType $productType
 * @property User $userCreate
 * @property User $userUpdate
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['product_type_id', 'user_create'], 'required'],
            [['product_type_id', 'user_create', 'user_update', 'is_delete', 'is_active', 'is_index', 'is_home', 'is_view', 'is_display', 'create_date', 'update_date', 'status', 'start_date_sale', 'end_date_sale'], 'integer'],
            [['price', 'sale', 'discount', 'lat', 'lng', 'rate'], 'number'],
            [['name', 'short_description', 'image', 'website'], 'string', 'max' => 200]
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
            'description' => 'Description',
            'product_type_id' => 'Product Type ID',
            'short_description' => 'Short Description',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
            'price' => 'Price',
            'sale' => 'Sale',
            'discount' => 'Discount',
            'image' => 'Image',
            'is_index' => 'Is Index',
            'is_home' => 'Is Home',
            'website' => 'Website',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'is_view' => 'Is View',
            'is_display' => 'Is Display',
            'rate' => 'Rate',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'status' => 'Status',
            'start_date_sale' => 'Start Date Sale',
            'end_date_sale' => 'End Date Sale',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColors()
    {
        return $this->hasMany(Color::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCreate()
    {
        return $this->hasOne(User::className(), ['id' => 'user_create']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserUpdate()
    {
        return $this->hasOne(User::className(), ['id' => 'user_update']);
    }
}
