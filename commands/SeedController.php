<?php

namespace app\commands;

use app\models\Employee;
use app\models\EmployeeJob;
use app\models\User;
use Faker\Factory;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class SeedController extends Controller
{
    /**
     * seed database with fake data
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {

        $transaction = Yii::$app->db->beginTransaction();
        Employee::deleteAll();
        EmployeeJob::deleteAll();
        $transaction->commit();

        $faker = Factory::create('ru_RU');

        $this->stdout('Seeding database with fake data...');

        for ($i = 1; $i < 100; $i++) {
            $transaction = Yii::$app->db->beginTransaction();
            $employee = $this->createEmployee($faker, $i);

            for ($j = 0; $j < $faker->numberBetween(1, 10); $j++) {
                $this->createEmployeeJob($faker, $employee);
            }
            $transaction->commit();
        }

        return ExitCode::OK;
    }

    /**
     * @param Faker\Factory $faker
     * @param int $id
     * @return Employee
     */
    private function createEmployee($faker, $id)
    {
        $gender_int = $faker->randomElement([0, 1]);
        $gender = $gender_int ? 'female' : 'male';

        $employee = new Employee();
        $employee->detachBehavior('timestamp');
        $employee->detachBehavior('blameable');

        $employee->id = $id;
        $employee->firstname = $faker->firstName($gender);
        $employee->surname = $faker->middleName($gender);
        $employee->lastname = $faker->lastName($gender);
        $employee->birthday = $faker->date();
        $employee->gender = $gender_int;

        $employee->created_by = User::findOne(['username' => 'admin'])->id;
        $employee->updated_by = $employee->created_by;

        $created_at = $faker->dateTimeBetween('-30 days', '-1 day');
        $employee->created_at = $created_at->getTimestamp();
        $employee->updated_at = $faker->dateTimeBetween($created_at, 'now')->getTimestamp();

        $employee->save();

        return $employee;
    }

    /**
     * @param Faker\Factory $faker
     * @param Employee $employee
     */
    private function createEmployeeJob($faker, $employee)
    {
        $job = new EmployeeJob();
        $job->detachBehavior('timestamp');
        $job->detachBehavior('blameable');

        $job->employee_id = $employee->id;
        $job->company = $faker->company();
        $job->begin_at = $faker->dateTimeBetween('-10 years', '-1 year')->format('Y-m-d');
        $job->end_at = $faker->dateTimeBetween($job->begin_at, 'now')->format('Y-m-d');

        $job->created_by = $employee->created_by;
        $job->updated_by = $job->created_by;

        $created_at = $faker->unique()->dateTimeBetween('-30 days', '-7 days');
        $job->created_at = $created_at->getTimestamp();
        $job->updated_at = $faker->dateTimeBetween($created_at, '-1 day')->getTimestamp();

        $job->save();
    }
}
