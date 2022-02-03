<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerAddressesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
	private function fetchCustomerAddresses()
	{
		$this->get('api/customers/addresses');
		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Searching for address of customers test');
		$this->assertNotEmpty($response['data']);
	}

	private function storeCustomerAddress()
	{
		$data = [
			'name'=>'Casa dos pais',
			'addresses_id'=>2
		];

		$this->post('api/customers/store', $data);
		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Store for address of customers test');
	}

	private function updateCustomerAddress()
	{
		$data = [
			'name'=>'casa da mãe',
			'addresses_id'=>3
		];
		$this->put('api/customers/update/1', $data);
		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Update address of customers test');
	}

	private function reverseUpdateCustomerAddress()
	{
		$data = [
			'name'=>'casa',
			'addresses_id'=>1
		];
		$this->put('api/customers/update/1', $data);
		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Update address of customers test');
	}

	private function deleteCustomerAddresses()
	{
		$lastCustomerAddressesId = DB::table('customers_addresses')->select('id')->whereNull('deleted_at')->orderBy('id', 'desc')->limit(1)->first()->id;
		$this->delete("api/customers/delete/$lastCustomerAddressesId");
		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Address of customers deleted test');
	}

    public function testExample()
    {
		$this->fetchCustomerAddresses();
		$this->storeCustomerAddress();
		$this->updateCustomerAddress();
		$this->reverseUpdateCustomerAddress();
		$this->deleteCustomerAddresses();
    }
}
