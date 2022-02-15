<?php

namespace App\Http\Domain;

use App\Http\Infra\AddressRepository;

class AddressDomain extends AddressRepository
{
	public function getAddress($address)
	{
		return $this->searchAddress($address);
	}
}
