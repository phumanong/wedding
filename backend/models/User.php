<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $status
 * @property integer $is_admin
 * @property string $token
 * @property integer $expired_date
 * @property integer $created_date
 * @property integer $employee_id
 * @property integer $is_delete
 *
 * @property Category[] $categories
 * @property Category[] $categories0
 * @property Product[] $products
 * @property Product[] $products0
 * @property ProductType[] $productTypes
 * @property ProductType[] $productTypes0
 * @property Employee $employee
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'status', 'is_admin', 'expired_date', 'created_date', 'employee_id', 'is_delete'], 'integer'],
            [['password_hash'], 'string'],
            [['user_name'], 'string', 'max' => 200],
            [['auth_key'], 'string', 'max' => 500],
            [['token'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'status' => 'Status',
            'is_admin' => 'Is Admin',
            'token' => 'Token',
            'expired_date' => 'Expired Date',
            'created_date' => 'Created Date',
            'employee_id' => 'Employee ID',
            'is_delete' => 'Is Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['user_create' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Category::className(), ['user_update' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['user_create' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Product::className(), ['user_update' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['user_create' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes0()
    {
        return $this->hasMany(ProductType::className(), ['user_update' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
