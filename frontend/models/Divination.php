<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "divination".
 *
 * @property integer $id
 * @property string $year_age
 * @property string $create_date
 * @property integer $user_create
 * @property integer $user_update
 * @property string $zodiac
 * @property string $par_year_male
 * @property string $par_year_female
 * @property string $supply_clause_male
 * @property string $supply_clause_female
 * @property string $color_male
 * @property string $color_female
 * @property string $element
 */
class Divination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'divination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['user_create', 'user_update'], 'integer'],
            [['zodiac', 'par_year_male', 'par_year_female', 'supply_clause_male', 'supply_clause_female', 'color_male', 'color_female', 'element'], 'required'],
            [['year_age'], 'string', 'max' => 5],
            [['zodiac', 'par_year_male', 'par_year_female', 'supply_clause_male', 'supply_clause_female', 'color_male', 'color_female', 'element'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_age' => 'Year Age',
            'create_date' => 'Create Date',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'zodiac' => 'Zodiac',
            'par_year_male' => 'Par Year Male',
            'par_year_female' => 'Par Year Female',
            'supply_clause_male' => 'Supply Clause Male',
            'supply_clause_female' => 'Supply Clause Female',
            'color_male' => 'Color Male',
            'color_female' => 'Color Female',
            'element' => 'Element',
        ];
    }
}
