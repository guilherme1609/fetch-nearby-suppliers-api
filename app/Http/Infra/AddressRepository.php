<?php

namespace App\Http\Infra;

use Illuminate\Support\Facades\DB;

class AddressRepository
{
	public function searchAddress($address)
	{
		return DB::table('address')->select(
			'id',
			'street',
			'number',
			'postal_code',
			'neighborhood',
			'city',
			'state',
			'country',
			'lat',
			'long'
		)
		->whereNull('deleted_at')
		->where(DB::raw("concat(street, ', ', number, ', ', city, ', ', state)"), 'like', "%$address%")
		->get()
		->toArray();
	}
}
