<?php

namespace App\Http\Infra;

use Illuminate\Support\Facades\DB;
/*
	CONSULTA PARA ENCONTRAR OS FORNECEDORES MAIS PROXIMOS DO ENDEREÇO FORNECIDO QUE ATENDAM AO RAIO ESPECIFICADO PARA ATENDIMENTO
	ORDENANDO PELO MAIS PROXIMO
*/

class SuppliersRepository
{
	public function fetchNearbySuppliers($latitude, $longitude)
	{
		if (!$latitude || !$longitude) {
			return false;
		}

		return DB::table('suppliers_addresses')->select(
			'suppliers.name',
			'suppliers.range',
			'addresses.street',
			'addresses.number',
			'addresses.postal_code',
			'addresses.neighborhood',
			'addresses.city',
			'addresses.state',
			'addresses.country',
			'addresses.lat',
			'addresses.long',
			DB::raw("(6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(`lat`)) * COS(RADIANS(`long`) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(`lat`)))) AS distance")
		)
			->join('suppliers', function ($join) {
				$join->on('suppliers.id', '=', 'suppliers_addresses.suppliers_id');
				$join->whereNull('suppliers.deleted_at');
			})
			->join('addresses', function ($join) {
				$join->on('addresses.id', '=', 'suppliers_addresses.addresses_id');
				$join->whereNull('addresses.deleted_at');
			})
			->whereNull('suppliers_addresses.deleted_at')
			->whereRaw("(6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(`lat`)) * COS(RADIANS(`long`) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(lat)))) <= `suppliers`.`range`")
			->orderBy('distance')
			->get()->toArray();
	}
}
