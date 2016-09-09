<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $id
 * @property string $product_type_name
 * @property integer $user_create
 * @property integer $user_update
 * @property string $create_date
 * @property string $update_date
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_create', 'user_update'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['product_type_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_type_name' => 'Product Type Name',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }
}
