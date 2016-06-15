<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LanguageTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages');
    }

    /*... create new language ...*/
    public function testInsertLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages')
        ->click('Create New')
        ->seePageIs('/language_insert')
        ->type('new language','title')
        ->type(1,'value')
        ->press('Submit');
        $this->seeInDatabase('language', ['name' => 'new language','value' => 1]);
    }

    /*... dowload language data as pdf ...*/
    public function testExportPdfLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages')
        ->click('Export Data')
        ->click('PDF');
    }

    /*... dowload language data as picture of png format ...*/
    public function testExpotPngLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages')
        ->click('Export Data')
        ->click('PNG');
    }

    /*... dowload language data as json file format ...*/
    public function testExpotJsonLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages')
        ->click('Export Data')
        ->click('JSON')
        ->click('JSON (ignoreColumn)')
        ->click('JSON (with Escape)');
    }

    /*... dowload language data as ms excel sheet ...*/
    public function testExpotXlsLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages')
        ->click('Export Data')
        ->click('XLS');
    }

    /*... dowload language data as xml file ...*/
    public function testExpotXmlLang()
    {
        $this->testLogin2Example();
        $this->visit('/languages')
        ->click('Export Data')
        ->click('XML');
    }

}