<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_delete
 * @property string $address
 *
 * @property Employee[] $employees
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_delete'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 250]
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
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['branch_id' => 'id']);
    }
}
