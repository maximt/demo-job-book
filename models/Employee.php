<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property int $id
 * @property string $firstname
 * @property string|null $surname
 * @property string $lastname
 * @property date|null $birthday
 * @property int|null $gender
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * calculated field (see \app\models\EmployeeSearch)
     * @var int
     */
    public $job_count;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'surname', 'lastname'], 'string', 'max' => 255],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['gender', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['gender'], 'in', 'range' => [0, 1]],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
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
            'firstname' => 'Имя',
            'surname' => 'Отчество',
            'lastname' => 'Фамилия',
            'birthday' => 'Дата рождения',
            'gender' => 'Пол',
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

    /**
     * Gets query for [[EmployeeJobs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeJobs()
    {
        return $this->hasMany(EmployeeJob::class, ['employee_id' => 'id']);
    }

    public function beforeDelete()
    {
        try {

            $transaction = Yii::$app->db->beginTransaction();
            if (parent::beforeDelete()) {
                foreach ($this->employeeJobs as $job) {
                    $job->delete();
                }
                $transaction->commit();
                return true;
            }
        } catch (\Exception $e) {
            throw $e; // throw through
        }

        $transaction->rollBack();

        return false;
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return implode(' ', [$this->firstname, $this->surname, $this->lastname]);
    }

    /**
     * @return string
     */
    function getGenderLabel()
    {
        return ($this->gender == 0 ? 'Мужской' : 'Женский');
    }
}
