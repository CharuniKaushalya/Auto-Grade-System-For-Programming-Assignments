<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
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

    public function testRegisterExample()
    {
        $this->visit('/register')
        ->type('sasrika', 'name')
         ->type('sasrika9@gmail.com', 'email')
         ->type('1234567', 'password')
         ->type('1234567', 'password_confirmation')
         ->press('Register')
         ->seePageIs('/admin');
    }
    
}
