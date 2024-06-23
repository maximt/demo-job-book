<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%employee_jobs}}".
 *
 * @property int $id
 * @property int $employee_id
 * @property date $begin_at
 * @property date|null $end_at
 * @property string $company
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
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
            [['employee_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['begin_at', 'end_at'], 'date', 'format' => 'php:Y-m-d'],
            [['company'], 'string', 'max' => 256],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            ['end_at', 'compare', 'compareAttribute' => 'begin_at', 'operator' => '>='],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            'blameable' => [
                'class' => BlameableBehavior::class
            ],
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
            'created_by' => 'Кто создал',
            'updated_by' => 'Кто изменил',
            'created_at' => 'Когда создан',
            'updated_at' => 'Когда изменен',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

}
