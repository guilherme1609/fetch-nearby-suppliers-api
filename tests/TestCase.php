<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
	public $faker;
	public $token;

    public function createApplication()
    {
		$this->faker = Faker\Factory::create();
        return require __DIR__.'/../bootstrap/app.php';
    }
}
