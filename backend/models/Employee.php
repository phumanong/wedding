<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property integer $is_official
 * @property integer $is_disable
 * @property integer $is_delete
 * @property integer $is_active
 * @property integer $marital_id
 * @property integer $branch_id
 * @property integer $group_id
 * @property string $code
 * @property string $full_name
 * @property integer $birthday
 * @property double $phone
 * @property string $email
 * @property string $permanent_residence
 * @property string $temporary_residence
 * @property string $identity_card
 * @property string $education
 * @property string $tax_code
 * @property string $coverage_code
 * @property string $address
 * @property integer $date_in
 * @property integer $date_out
 * @property string $nationality
 * @property string $nation
 * @property string $religiousness
 * @property string $health_code
 * @property integer $gender
 * @property integer $session_id
 *
 * @property Branch $branch
 * @property Group $group
 * @property Marital $marital
 * @property Session $session
 * @property Timekeeping[] $timekeepings
 * @property User[] $users
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_official', 'is_disable', 'is_delete', 'is_active', 'marital_id', 'branch_id', 'group_id', 'birthday', 'date_in', 'date_out', 'gender', 'session_id'], 'integer'],
            [['phone'], 'number'],
            [['session_id'], 'required'],
            [['code', 'full_name', 'email'], 'string', 'max' => 200],
            [['permanent_residence', 'temporary_residence', 'address'], 'string', 'max' => 250],
            [['identity_card', 'education', 'tax_code', 'coverage_code', 'nationality', 'nation', 'religiousness', 'health_code'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_official' => 'Is Official',
            'is_disable' => 'Is Disable',
            'is_delete' => 'Is Delete',
            'is_active' => 'Is Active',
            'marital_id' => 'Marital ID',
            'branch_id' => 'Branch ID',
            'group_id' => 'Group ID',
            'code' => 'Code',
            'full_name' => 'Full Name',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'email' => 'Email',
            'permanent_residence' => 'Permanent Residence',
            'temporary_residence' => 'Temporary Residence',
            'identity_card' => 'Identity Card',
            'education' => 'Education',
            'tax_code' => 'Tax Code',
            'coverage_code' => 'Coverage Code',
            'address' => 'Address',
            'date_in' => 'Date In',
            'date_out' => 'Date Out',
            'nationality' => 'Nationality',
            'nation' => 'Nation',
            'religiousness' => 'Religiousness',
            'health_code' => 'Health Code',
            'gender' => 'Gender',
            'session_id' => 'Session ID',
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
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarital()
    {
        return $this->hasOne(Marital::className(), ['id' => 'marital_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::className(), ['id' => 'session_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimekeepings()
    {
        return $this->hasMany(Timekeeping::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['employee_id' => 'id']);
    }
}
