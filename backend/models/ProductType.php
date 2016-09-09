<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_create
 * @property integer $user_update
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $is_active
 * @property integer $is_delete
 *
 * @property Product[] $products
 * @property User $userCreate
 * @property User $userUpdate
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
            [['user_create'], 'required'],
            [['user_create', 'user_update', 'create_date', 'update_date', 'is_active', 'is_delete'], 'integer'],
            [['name'], 'string', 'max' => 200]
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
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_type_id' => 'id']);
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
