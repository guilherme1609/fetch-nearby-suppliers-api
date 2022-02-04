<?php

namespace App\Http\Domain;

use App\Http\Infra\CustomersAddressesRepository;

class CustomersAddressesDomain extends CustomersAddressesRepository
{
	public function getCustomerAddresses($customerId)
	{
		return $this->fetchCustomerAddresses($customerId);
	}
}
