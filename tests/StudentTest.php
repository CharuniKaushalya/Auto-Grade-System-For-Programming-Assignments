<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student');
    }

    /*... dowload student data as pdf ...*/
    public function testExportPdfStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student')
        ->click('Export Data')
        ->click('PDF');
    }

    /*... dowload student data as picture of png format ...*/
    public function testExpotPngStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student')
        ->click('Export Data')
        ->click('PNG');
    }

    /*... dowload student data as json file format ...*/
    public function testExpotJsonStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student')
        ->click('Export Data')
        ->click('JSON')
        ->click('JSON (ignoreColumn)')
        ->click('JSON (with Escape)');
    }

    /*... dowload student data as ms excel sheet ...*/
    public function testExpotXlsStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student')
        ->click('Export Data')
        ->click('XLS');
    }

    /*... dowload student data as xml file ...*/
    public function testExpotXmlStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student')
        ->click('Export Data')
        ->click('XML');
    }

    /*... update details ...*/
    public function testUpdateStudent()
    {
        $this->testLogin2Example();
        $this->visit('/student')
        ->click('Update')
        ->press('Update');
    }

    
}
