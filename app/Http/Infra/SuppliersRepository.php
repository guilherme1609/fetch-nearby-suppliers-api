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
		return DB::table('suppliers_addresses')->select(
			'suppliers.id',
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

	public function fetchAllNearbySuppliers($customerId)
	{
		$subQuerySuppliers = DB::table('suppliers_addresses')->select(
			DB::raw('suppliers_addresses.id AS idSupplierAddress'),
            DB::raw('suppliers.id AS idSupplier'),
            DB::raw('suppliers.`name` as supplier'),
            DB::raw('suppliers.`range`'),
            DB::raw('addresses.street'),
			DB::raw('addresses.`number`'),
			DB::raw('addresses.postal_code'),
			DB::raw('addresses.neighborhood'),
			DB::raw('addresses.city'),
			DB::raw('addresses.state'),
			DB::raw('addresses.country'),
            DB::raw('addresses.lat'),
            DB::raw('addresses.`long`')
		)
		->join('suppliers', function($join) {
			$join->on('suppliers.id', '=', 'suppliers_addresses.suppliers_id');
			$join->whereNull('suppliers.deleted_at');
		})
		->join('addresses', function($join) {
			$join->on('addresses.id', '=', 'suppliers_addresses.addresses_id');
			$join->whereNull('addresses.deleted_at');
		});


		return DB::table('customers_addresses')->select(
			DB::raw('customers_addresses.id as customerAddress'),
			DB::raw('customers.id as idCustomer'),
			DB::raw('customers.`name` as customer'),
			DB::raw('addresses.id as idCustomerAddress'),
			DB::raw('customers_addresses.`name` as addressName'),
			'spad.idSupplierAddress',
			'spad.idSupplier',
			'spad.supplier',
			'spad.range',
			'spad.street',
			'spad.number',
			'spad.postal_code',
			'spad.neighborhood',
			'spad.city',
			'spad.state',
			'spad.country',
			'spad.lat',
			'spad.long'
			)
			->join('customers', function ($join) {
				$join->on('customers.id', '=', 'customers_addresses.customers_id');
				$join->whereNull('customers.deleted_at');
			})
			->join('addresses', function ($join) {
				$join->on('addresses.id', '=', 'customers_addresses.addresses_id');
				$join->whereNull('addresses.deleted_at');
			})
			->joinSub($subQuerySuppliers, 'spad', function($join){})
			->where('customers_addresses.customers_id', $customerId)
			->whereNull('customers_addresses.deleted_at')
			->whereRaw("(6371 * ACOS(COS(RADIANS(addresses.lat)) * COS(RADIANS(spad.lat)) * COS(RADIANS(`spad`.`long`) - RADIANS(`addresses`.`long`)) + SIN(RADIANS(addresses.lat)) * SIN(RADIANS(spad.lat)))) <= `spad`.`range`")
			->get()->toArray();
	}
}
