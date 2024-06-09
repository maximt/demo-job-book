<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%employee_jobs}}".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $begin_at
 * @property string|null $end_at
 * @property string $company
 */
class EmployeeJob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee_jobs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'begin_at', 'company'], 'required'],
            [['employee_id'], 'integer'],
            [['begin_at', 'end_at'], 'safe'],
            [['company'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Сотрудник',
            'begin_at' => 'Начало работы',
            'end_at' => 'Конец работы',
            'company' => 'Название организации',
        ];
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

}
