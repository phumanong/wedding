<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "materia_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_date
 * @property string $update_date
 * @property integer $is_active
 * @property integer $is_delete
 */
class MateriaType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materia_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_date'], 'safe'],
            [['is_active', 'is_delete'], 'integer'],
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
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
        ];
    }
}
