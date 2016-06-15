<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleAndPrivilegeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles');
    }

    /*... create new role ...*/
    public function testInsertRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles')
        ->click('Create New')
        ->seePageIs('/role_insert')
        ->type('new member','title')
        ->press('Submit');
        $this->seeInDatabase('role', ['name' => 'new member']);
    }

    /*... dowload user roles data as pdf ...*/
    public function testExportPdfRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles')
        ->click('Export Data')
        ->click('PDF');
    }

    /*... dowload ser roles data as picture of png format ...*/
    public function testExpotPngRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles')
        ->click('Export Data')
        ->click('PNG');
    }

    /*... dowload ser roles data as json file format ...*/
    public function testExpotJsonRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles')
        ->click('Export Data')
        ->click('JSON')
        ->click('JSON (ignoreColumn)')
        ->click('JSON (with Escape)');
    }

    /*... dowload ser roles data as ms excel sheet ...*/
    public function testExpotXlsRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles')
        ->click('Export Data')
        ->click('XLS');
    }

    /*... dowload ser roles data as xml file ...*/
    public function testExpotXmlRole()
    {
        $this->testLogin2Example();
        $this->visit('/roles')
        ->click('Export Data')
        ->click('XML');
    }

    /*... view all user previleges page ...*/
    public function testIndexPrevilege()
    {
        $this->testLogin2Example();
        $this->visit('/privileges');
    }

    /*... dowload all user previleges data as pdf ...*/
    public function testInsertPrevilege()
    {
        $this->testLogin2Example();
        $this->visit('/privileges')
        ->click('Create New')
        ->seePageIs('/privilege_insert')
        ->type('new privilege','title')
        ->press('Submit');
        $this->seeInDatabase('privilege', ['name' => 'new privilege']);
    }

    /*... dowload all user previleges data as picture of png format ...*/
    public function testExpotPngPrevilege()
    {
        $this->testLogin2Example();
        $this->visit('/privileges')
        ->click('Export Data')
        ->click('PNG');
    }

    /*... dowload all user previleges data as json file format ...*/
    public function testExpotJsonPrevilege()
    {
        $this->testLogin2Example();
        $this->visit('/privileges')
        ->click('Export Data')
        ->click('JSON')
        ->click('JSON (ignoreColumn)')
        ->click('JSON (with Escape)');
    }

    /*... dowload all user previleges data as ms excel sheet ...*/
    public function testExpotXlsPrevilege()
    {
        $this->testLogin2Example();
        $this->visit('/privileges')
        ->click('Export Data')
        ->click('XLS');
    }

    /*... dowload all user previleges data as xml file ...*/
    public function testExpotXmlPrevilege()
    {
        $this->testLogin2Example();
        $this->visit('/privileges')
        ->click('Export Data')
        ->click('XML');
    }


    
}
