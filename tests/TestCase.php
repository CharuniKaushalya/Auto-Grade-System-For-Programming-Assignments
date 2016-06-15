<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    //previous - http://localhost
    protected $baseUrl = 'http://localhost:800';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function testLogin2Example()
    {
        $this->visit('/login')
         ->type('snkaushi@gmail.com', 'email')
         ->type('1234567', 'password')
         ->press('Login')
         ->seePageIs('/admin');
    }
}
