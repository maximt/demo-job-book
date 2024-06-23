<?php

namespace tests\unit\models;

use app\models\Employee;
use Codeception\Test\Unit;

class EmployeeTest extends Unit
{

    private function _createEmployee()
    {
        $employee = new Employee();
        $employee->id = 1;
        $employee->firstname = 'John';
        $employee->lastname = 'Smith';
        $employee->save();

        return $employee;
    }

    public function testValidation()
    {
        $employee = new Employee();

        $this->assertFalse($employee->validate(['firstname'])); // test empty fields
        $this->assertFalse($employee->validate(['lastname']));

        $employee->firstname = 'John';
        $employee->surname = null; // not required
        $employee->lastname = 'Doe';

        $this->assertTrue($employee->validate());

        $employee->gender = 2;
        $this->assertFalse($employee->validate(['gender']));

        $employee->gender = 1;
        $this->assertTrue($employee->validate(['gender']));

        $employee->birthday = 'not-a-date';
        $this->assertFalse($employee->validate(['birthday']));

        $employee->birthday = '1980-01-01';
        $this->assertTrue($employee->validate(['birthday']));
    }

    public function testCreateEmployee()
    {
        $employee = new Employee();
        $employee->firstname = 'John';
        $employee->surname = 'Doe';
        $employee->lastname = 'Smith';
        $employee->birthday = '1980-01-01';
        $employee->gender = 0;

        $this->assertTrue($employee->save(), 'Employee created successfully');
    }

}
