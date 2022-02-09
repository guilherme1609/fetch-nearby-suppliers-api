<?php

namespace App\Http\Infra;

use Illuminate\Support\Facades\DB;

class CustomersAddressesRepository
{
	public function fetchCustomerAddresses($customerId)
	{
		return DB::table('customers_addresses')->select(
			'customers_addresses.id',
			'customers_addresses.name',
			'addresses.street',
			'addresses.number',
			'addresses.postal_code',
			'addresses.neighborhood',
			'addresses.city',
			'addresses.state',
			'addresses.country',
			DB::raw("concat(addresses.street, ', ',addresses.number, ', ', addresses.neighborhood, ', ', addresses.city, ', ', addresses.state) as address"),
			'addresses.lat',
			'addresses.long'
		)
			->join('addresses', function ($join) {
				$join->on('addresses.id', '=', 'customers_addresses.addresses_id');
				$join->whereNull('customers_addresses.deleted_at');
			})
			->whereNull('addresses.deleted_at')
			->where('customers_addresses.customers_id', $customerId)
			->get()->toArray();
	}
}
