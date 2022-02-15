<?php

namespace App\Http\Infra;

use Illuminate\Support\Facades\DB;

class CustomerAddressRepository
{
	public function fetchCustomerAddresses($customerId)
	{
		return DB::table('customer_address')->select(
			'customer_address.id',
			'customer_address.name',
			'address.street',
			'address.number',
			'address.postal_code',
			'address.neighborhood',
			'address.city',
			'address.state',
			'address.country',
			DB::raw("concat(address.street, ', ',address.number, ', ', address.neighborhood, ', ', address.city, ', ', address.state) as address"),
			'address.lat',
			'address.long'
		)
			->join('address', function ($join) {
				$join->on('address.id', '=', 'customer_address.address_id');
				$join->whereNull('customer_address.deleted_at');
			})
			->whereNull('address.deleted_at')
			->where('customer_address.customer_id', $customerId)
			->get()->toArray();
	}
}
