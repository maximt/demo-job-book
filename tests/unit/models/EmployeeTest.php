<?php

namespace models;

use Yii;
use app\models\Employee;
use app\models\User;

class EmployeeTest extends \Codeception\Test\Unit
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

    private function _createUser($id = 999)
    {
        $owner = new User();
        $owner->id = $id;
        $owner->username = "user{$id}";
        $owner->auth_key = '123456';
        $owner->password_hash = '123456';
        $owner->email = "user{$id}@example.com";
        $owner->save();

        return $owner;
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

    public function testReadEmployee()
    {
        $this->_createEmployee();

        $employee = Employee::findOne(1);
        $this->assertNotNull($employee, 'Employee should be found');
        $this->assertEquals('John', $employee->firstname, 'First name should be John');
    }

    public function testUpdateEmployee()
    {
        $this->_createEmployee();

        $employee = Employee::findOne(1);

        $this->assertNotNull($employee, 'Employee should be found');

        $employee->firstname = 'Jane';
        $this->assertTrue($employee->save(), 'Employee should be updated successfully');

        $updatedEmployee = Employee::findOne(1);
        $this->assertEquals('Jane', $updatedEmployee->firstname, 'First name should be Jane');
    }

    public function testDeleteEmployee()
    {
        $this->_createEmployee();

        $employee = Employee::findOne(1);
        $this->assertNotNull($employee, 'Employee should be found');

        $deleted_count = $employee->delete();
        $this->assertTrue($deleted_count > 0, 'Employee should be deleted successfully');

        $deletedEmployee = Employee::findOne(1);
        $this->assertNull($deletedEmployee, 'Employee should not be found');
    }

    public function testBlameableBehavior()
    {
        // created_by

        $owner = $this->_createUser(999);
        Yii::$app->user->setIdentity($owner);

        $employee = $this->_createEmployee();
        $this->assertEquals(999, $employee->created_by, 'created_by should be set to current user ID');
        $this->assertEquals(999, $employee->updated_by, 'updated_by should be set to current user ID');

        // updated_by

        $owner2 = $this->_createUser(777);
        Yii::$app->user->setIdentity($owner2);

        $employee->firstname = 'Jane';
        $employee->save();
        $this->assertEquals(777, $employee->updated_by, 'updated_by should be updated to current user ID');
    }

    public function testTimestampBehavior()
    {
        // created_at
        $employee = $this->_createEmployee();
        $this->assertNotNull($employee->created_at, 'created_at should be set');
        $this->assertNotNull($employee->updated_at, 'updated_at should be set');

        // updated_at
        $employee->firstname = 'Jane';
        sleep(1); // pause before updating for different timestamps in updated_at and created_at
        $employee->save();
        $this->assertNotEquals($employee->created_at, $employee->updated_at, 'updated_at should be updated');
    }

}
