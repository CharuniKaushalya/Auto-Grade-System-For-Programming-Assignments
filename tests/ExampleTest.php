<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testLoginExample()
    {
        $this->visit('/login')
         ->type('snkaushi@gmail.com', 'email')
         ->type('1234567', 'password')
         ->press('Login')
         ->seePageIs('/admin');
    }
    public function testHome()
    {
        $this->visit('/')
             ->see('Cnsytex');
    }
    public function testBasicExample()
    {
        $this->testLogin2Example();
        $this->visit('/')
             ->click('About Us')
             ->seePageIs('/about');
        $this->visit('/')
             ->see('Cnsytex');
    }

    public function testPage()
    {
        $this->testLogin2Example();
        $this->visit('/')
             ->click('About Us')
             ->seePageIs('/about');
    }

    
}
