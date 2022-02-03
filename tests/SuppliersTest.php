<?php

class SuppliersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

	private function fetchNerbySuppliers()
	{
		$query = 'latitude=-25.4487700&longitude=-49.30393000000000';

		$this->get("api/suppliers/fetch-nearby?$query");

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success');
		$this->assertNotEmpty($response['data']);

	}

	private function fetchUnknownSuppliers()
	{
		$query = 'latitude=-29.4487700&longitude=-47.30393000000000';
		$this->get("api/suppliers/fetch-nearby?$query");

		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'],'error');
	}

    public function testSuppliers()
    {
        $this->fetchNerbySuppliers();
		$this->fetchUnknownSuppliers();
    }
}
