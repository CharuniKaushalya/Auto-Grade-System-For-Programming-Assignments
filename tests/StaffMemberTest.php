<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StafMemberTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexStaff()
    {
        $this->testLogin2Example();
        $this->visit('/user');
    }

    /*... create new staff memeber...*/
    public function testInsertStaff()
    {
        $this->testLogin2Example();

        $this->visit('/user')
        ->click('Create New')
        ->seePageIs('/staff_register')
        ->type('new member','name')
        ->type('120456U','empid')
        ->type('new@gmail.com','email')
        ->type('1234567', 'password')
        ->select(1,'gender')
        ->select(2,'role')
        ->type('54/B, Kadawala Road, Delgoda', 'address')
        ->press('submit')
        ->seePageIs('/staff_register');

        $this->seeInDatabase('users', [
            'user_name' => 'new member',
            'email' => 'new@gmail.com',
            'address' => '54/B, Kadawala Road, Delgoda',
            'role_id' => 2,
            'gender_id' => 1,
            ]);
    }

    /*... update staff memeber details ...*/
    public function testUpdateStaff()
    {
        $this->testLogin2Example();
        $this->visit('/user')
        ->click('Update')
        ->type('Kasunika','name')
        ->press('Update');
        $this->seeInDatabase('users', ['user_name' => 'kasunika']);
    }


    /*... dowload new staff data as pdf ...*/
    public function testExportPdfStaff()
    {
        $this->testLogin2Example();
       $this->visit('/user')
        ->click('Export Data')
        ->click('PDF');
    }

    /*... dowload new staff data as picture of png format ...*/
    public function testExpotPngStaff()
    {
        $this->testLogin2Example();
        $this->visit('/user')
        ->click('Export Data')
        ->click('PNG');
    }

    /*... dowload new staff data as json file format ...*/
    public function testExpotJsonStaff()
    {
        $this->testLogin2Example();
        $this->visit('/user')
        ->click('Export Data')
        ->click('JSON')
        ->click('JSON (ignoreColumn)')
        ->click('JSON (with Escape)');
    }

    /*... dowload new staff data as ms excel sheet ...*/
    public function testExpotXlsStaff()
    {
        $this->testLogin2Example();
        $this->visit('/user')
        ->click('Export Data')
        ->click('XLS');
    }

    /*... dowload new staff data as xml file ...*/
    public function testExpotXmlStaff()
    {
        $this->testLogin2Example();
        $this->visit('/user')
        ->click('Export Data')
        ->click('XML');
    }

    
    
}
