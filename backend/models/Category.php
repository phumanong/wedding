<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $is_home
 * @property integer $is_delete
 * @property integer $is_active
 * @property integer $is_index
 * @property integer $parent_id
 * @property integer $is_menu
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $user_create
 * @property integer $user_update
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'is_home', 'is_delete', 'is_active', 'is_index', 'parent_id', 'is_menu', 'create_date', 'update_date', 'user_create', 'user_update'], 'integer'],
            [['name', 'description'], 'string', 'max' => 500]
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
            'is_home' => 'Is Home',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
            'is_index' => 'Is Index',
            'parent_id' => 'Parent ID',
            'is_menu' => 'Is Menu',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
        ];
    }
}
