<?php

namespace App\Http\Infra;

use Illuminate\Support\Facades\DB;
/*
	CONSULTA PARA ENCONTRAR OS FORNECEDORES MAIS PROXIMOS DO ENDEREÇO FORNECIDO QUE ATENDAM AO RAIO ESPECIFICADO PARA ATENDIMENTO
*/

class SupplierRepository
{
	public function fetchNearbySuppliers($latitude, $longitude)
	{
		return DB::table('supplier_address')->select(
			'supplier.id',
			'supplier.name',
			'supplier.range',
			'address.street',
			'address.number',
			'address.postal_code',
			'address.neighborhood',
			'address.city',
			'address.state',
			'address.country',
			'address.lat',
			'address.long',
			DB::raw("(6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(`lat`)) * COS(RADIANS(`long`) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(`lat`)))) AS distance")
		)
			->join('supplier', function ($join) {
				$join->on('supplier.id', '=', 'supplier_address.supplier_id');
				$join->whereNull('supplier.deleted_at');
			})
			->join('address', function ($join) {
				$join->on('address.id', '=', 'supplier_address.address_id');
				$join->whereNull('address.deleted_at');
			})
			->whereNull('supplier_address.deleted_at')
			->whereRaw("(6371 * ACOS(COS(RADIANS($latitude)) * COS(RADIANS(`lat`)) * COS(RADIANS(`long`) - RADIANS($longitude)) + SIN(RADIANS($latitude)) * SIN(RADIANS(lat)))) <= `supplier`.`range`")
			// ->orderBy('distance')
			->get()->toArray();
	}

	public function fetchAllNearbySuppliers($customerId)
	{
		$subQuerySuppliers = DB::table('supplier_address')->select(
			DB::raw('supplier_address.id AS idSupplierAddress'),
            DB::raw('supplier.id AS idSupplier'),
            DB::raw('supplier.`name` as supplier'),
            DB::raw('supplier.`range`'),
            DB::raw('address.street'),
			DB::raw('address.`number`'),
			DB::raw('address.postal_code'),
			DB::raw('address.neighborhood'),
			DB::raw('address.city'),
			DB::raw('address.state'),
			DB::raw('address.country'),
            DB::raw('address.lat'),
            DB::raw('address.`long`')
		)
		->join('supplier', function($join) {
			$join->on('supplier.id', '=', 'supplier_address.supplier_id');
			$join->whereNull('supplier.deleted_at');
		})
		->join('address', function($join) {
			$join->on('address.id', '=', 'supplier_address.address_id');
			$join->whereNull('address.deleted_at');
		})->whereNull('supplier_address.deleted_at');


		return DB::table('customer_address')->select(
			DB::raw('customer_address.id as customerAddress'),
			DB::raw('customer.id as idCustomer'),
			DB::raw('customer.`name` as customer'),
			DB::raw('address.id as idCustomerAddress'),
			DB::raw('customer_address.`name` as addressName'),
			DB::raw("concat(address.street, ', ',address.number, ', ', address.neighborhood, ', ', address.city, ', ', address.state) as address"),
			DB::raw('address.street as customer_street'),
			DB::raw('address.number as customer_number'),
			DB::raw('address.postal_code as customer_postal_code'),
			DB::raw('address.neighborhood as customer_neighborhood'),
			DB::raw('address.city as customer_city'),
			DB::raw('address.state as customer_state'),
			DB::raw('address.country as customer_country'),
			DB::raw('address.lat as customer_lat'),
			DB::raw('address.long as customer_long'),
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
			->join('customer', function ($join) {
				$join->on('customer.id', '=', 'customer_address.customer_id');
				$join->whereNull('customer.deleted_at');
			})
			->join('address', function ($join) {
				$join->on('address.id', '=', 'customer_address.address_id');
				$join->whereNull('address.deleted_at');
			})
			->joinSub($subQuerySuppliers, 'spad', function($join){})
			->where('customer_address.customer_id', $customerId)
			->whereNull('customer_address.deleted_at')
			->whereRaw("(6371 * ACOS(COS(RADIANS(address.lat)) * COS(RADIANS(spad.lat)) * COS(RADIANS(`spad`.`long`) - RADIANS(`address`.`long`)) + SIN(RADIANS(address.lat)) * SIN(RADIANS(spad.lat)))) <= `spad`.`range`")
			->get()->toArray();
	}
}
