<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	private function createSession()
	{
		$login = [
			"email"=> "usuariophpunit@phpunit.com",
			"password"=> "123456789"
		];

		$this->post('api/auth/login', $login);
		$response = (array) json_decode($this->response->content(), true);
		if ($response) {
			$this->token = $response['token']['original']['token'];
		}
	}

	private function fetchAllSuppliers()
	{
		$this->get('api/customers/suppliers', ['Authorization'=>'Bearer '. $this->token]);
		$response = (array) json_decode($this->response->content());
		$this->assertEquals($response['status'],'success');
		$this->assertNotEmpty($response['data']);
		$this->assertIsArray($response['data']);
		$this->assertTrue(count($response['data']) > 0);
	}

    public function testExample()
    {
		$this->createSession();
		$this->fetchAllSuppliers();
    }
}
