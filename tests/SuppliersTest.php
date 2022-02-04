<?php

class SuppliersTest extends TestCase
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

	private function fetchNerbySuppliers()
	{
		$query = 'latitude=-25.4487700&longitude=-49.30393000000000';

		$this->get("api/suppliers/fetch-nearby?$query", ['Authorization'=>'Bearer '.$this->token]);

		$response = (array) json_decode($this->response->content());
		$this->assertEquals($response['status'], 'success');
		$this->assertNotEmpty($response['data']);
		$this->assertIsArray($response['data']);
		$this->assertTrue(count($response['data']) > 0);

	}

	private function fetchUnknownSuppliers()
	{
		$query = 'latitude=-29.4487700&longitude=-47.30393000000000';
		$this->get("api/suppliers/fetch-nearby?$query", ['Authorization'=>'Bearer '.$this->token]);

		$response = (array) json_decode($this->response->content());
		$this->assertEquals($response['status'],'error');
	}

    public function testSuppliers()
    {
		$this->createSession();
        $this->fetchNerbySuppliers();
		$this->fetchUnknownSuppliers();
    }
}
