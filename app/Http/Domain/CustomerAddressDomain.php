<?php

namespace App\Http\Domain;

use App\Http\Infra\CustomerAddressRepository;

class CustomerAddressDomain extends CustomerAddressRepository
{
	public function getCustomerAddresses($customerId)
	{
		return $this->fetchCustomerAddresses($customerId);
	}
}
