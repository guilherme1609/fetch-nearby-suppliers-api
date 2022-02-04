<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AddressesTest extends TestCase
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

	private function serchForAddress()
	{
		$address = 'Av.%20N.%20Sra.%20Aparecida,%20582,%20Curitiba,%20PR';
		$this->get("api/address/search-addresses?address=$address", ['Authorization' => 'Bearer ' . $this->token]);

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Searching for address test');
		$this->assertNotEmpty($response['data']);
		$this->assertIsArray($response['data']);
		$this->assertTrue(count($response['data']) > 0);
	}

	private function serchForUnknownAddress()
	{
		$address = 'Casa%20Verde,%20582,%20Curitiba,%20PR';

		$this->get("api/address/search-addresses?address=$address", ['Authorization' => 'Bearer ' . $this->token]);

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'],'error', 'Serching for unknown address test');
	}

	private function serchForIncompleteAddress()
	{
		$address = 'Casa%20Verde,%20Curitiba,%20PR';

		$this->get("api/address/search-addresses?address=$address", ['Authorization' => 'Bearer ' . $this->token]);

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'],'error', 'Searching for incomplete address test');

	}

    public function testExample()
    {
		$this->createSession();
        $this->serchForAddress();
        $this->serchForUnknownAddress();
        $this->serchForIncompleteAddress();
    }
}
