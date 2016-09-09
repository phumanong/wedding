<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $product_name
 * @property string $description
 * @property integer $product_type_id
 * @property string $short_description
 * @property integer $account_create
 * @property integer $account_update
 * @property integer $is_delete
 * @property integer $is_active
 * @property string $price
 * @property string $sale
 * @property double $discount
 * @property string $image
 * @property integer $index
 * @property integer $is_home
 * @property string $website
 * @property string $lat
 * @property string $long
 * @property integer $view
 * @property integer $view_display
 * @property integer $rate
 * @property string $color
 * @property string $create_date
 * @property string $update_date
 * @property integer $status
 * @property string $start_date_sale
 * @property string $end_date_sale
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
            [['product_name', 'product_type_id'], 'required'],
            [['description', 'short_description'], 'string'],
            [['product_type_id', 'account_create', 'account_update', 'is_delete', 'is_active', 'index', 'is_home', 'view', 'view_display', 'rate', 'status'], 'integer'],
            [['discount'], 'number'],
            [['create_date', 'update_date', 'start_date_sale', 'end_date_sale'], 'safe'],
            [['product_name', 'website'], 'string', 'max' => 500],
            [['price', 'sale', 'image', 'lat', 'long', 'color'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'description' => 'Description',
            'product_type_id' => 'Product Type ID',
            'short_description' => 'Short Description',
            'account_create' => 'Account Create',
            'account_update' => 'Account Update',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
            'price' => 'Price',
            'sale' => 'Sale',
            'discount' => 'Discount',
            'image' => 'Image',
            'index' => 'Index',
            'is_home' => 'Is Home',
            'website' => 'Website',
            'lat' => 'Lat',
            'long' => 'Long',
            'view' => 'View',
            'view_display' => 'View Display',
            'rate' => 'Rate',
            'color' => 'Color',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'status' => 'Status',
            'start_date_sale' => 'Start Date Sale',
            'end_date_sale' => 'End Date Sale',
        ];
    }
}
