<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "materia".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $branch_id
 * @property integer $materia_type_id
 * @property integer $quanlity
 * @property string $status
 * @property string $description
 *
 * @property Branch $branch
 * @property MateriaType $materiaType
 */
class Materia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date', 'update_date', 'branch_id', 'materia_type_id', 'quanlity'], 'integer'],
            [['branch_id', 'materia_type_id'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 45]
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
            'branch_id' => 'Branch ID',
            'materia_type_id' => 'Materia Type ID',
            'quanlity' => 'Quanlity',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateriaType()
    {
        return $this->hasOne(MateriaType::className(), ['id' => 'materia_type_id']);
    }
}
