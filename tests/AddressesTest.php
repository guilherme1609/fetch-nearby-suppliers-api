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
	private function serchForAddress()
	{
		$address = 'Av.%20N.%20Sra.%20Aparecida,%20582,%20Curitiba,%20PR';
		$this->get("api/address/fetch-address?address=$address");

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Searching for address test');
		$this->assertNotEmpty($response['data']);
	}

	private function serchForUnknownAddress()
	{
		$address = 'Casa%20Verde,%20582,%20Curitiba,%20PR';

		$this->get("api/address/fetch-address?address=$address");

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'],'error', 'Serching for unknown address test');
	}

	private function serchForIncompleteAddress()
	{
		$address = 'Casa%20Verde,%20Curitiba,%20PR';

		$this->get("api/address/fetch-address?address=$address");

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'],'error', 'Searching for incomplete address test');

	}

    public function testExample()
    {
        $this->serchForAddress();
        $this->serchForUnknownAddress();
        $this->serchForIncompleteAddress();
    }
}
