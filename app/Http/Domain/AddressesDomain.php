<?php

namespace App\Http\Domain;

use App\Http\Infra\AddressesRepository;

class AddressesDomain extends AddressesRepository
{
	public function getAddress($address)
	{
		return $this->searchAddress($address);
	}
}
