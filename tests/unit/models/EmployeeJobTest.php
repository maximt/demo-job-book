<?php
namespace models;

use app\models\EmployeeJob;

class EmployeeJobTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testValidation()
    {
        $job = new EmployeeJob();

        // Test required fields
        $this->assertFalse($job->validate(), 'Model should not validate without required fields');

        $job->employee_id = 1;
        $job->company = 'My Company';

        // Test invalid dates
        $job->begin_at = 'not-a-date';
        $job->end_at = 'not-a-date';

        $this->assertFalse($job->validate(), 'Model should not validate with invalid dates');

        // Test valid dates
        $job->begin_at = '2020-01-01';
        $job->end_at = '2024-01-01';

        $this->assertTrue($job->validate(), 'Model should validate with valid dates');

        // Test valid dates
        $job->begin_at = '2020-01-01';
        $job->end_at = null;

        $this->assertTrue($job->validate(), 'Model should validate without end date');

        // Test valid dates
        $job->begin_at = '2024-01-01';
        $job->end_at = '2020-01-01';

        $this->assertFalse($job->validate(), 'Model should not validate when begin date is after end date');
    }

}