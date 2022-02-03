<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddInitialData extends Migration
{
	private $dummyAddress = [
		[
			'street' => 'Av. N. Sra. Aparecida',
			'number' => '582',
			'neighborhood' => 'Seminário',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.44877,
			'long' => -49.30393
		],
		[
			'street' => 'Rua Brigadeiro Franco',
			'number' => '2300',
			'neighborhood' => 'Centro',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.44101455,
			'long' => -49.27736085423784
		],
		[
			'street' => 'Av. Iguaçu',
			'number' => '3151',
			'neighborhood' => 'Água Verde',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4452176,
			'long' => -49.2770471
		],
		[
			'street' => 'Av. Sete de Setembro',
			'number' => '5426',
			'neighborhood' => 'Batel',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4456001,
			'long' => -49.28710220061174
		],
		[
			'street' => 'Av. N. Sra. Aparecida',
			'number' => '661',
			'neighborhood' => 'Seminário',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4496774,
			'long' => -49.30505312662602
		],
		[
			'street' => 'R. Nunes Machado',
			'number' => '872',
			'neighborhood' => 'Rebouças',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4477004,
			'long' => -49.2706346
		],
		[
			'street' => 'Av. dos Estados',
			'number' => '1275',
			'neighborhood' => 'Água Verde',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4663425,
			'long' => -49.2857532
		],
		[
			'street' => 'R. Brigadeiro Franco',
			'number' => '1037',
			'neighborhood' => 'Mercês',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4295314,
			'long' => -49.2838007
		],
		[
			'street' => 'R. Brasílio Itiberê',
			'number' => '3545',
			'neighborhood' => 'Água Verde',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4472543,
			'long' => -49.2694677
		],
		[
			'street' => 'R. Padre Anchieta',
			'number' => '2665',
			'neighborhood' => 'Bigorrilho',
			'city' => 'Curitiba',
			'state' => 'PR',
			'country' => 'BR',
			'lat' => -25.4333405,
			'long' => -49.2999075
		]
	];

	private $dummyCustomers = [
		['id' => 1, 'name' => 'Lynn Homenick'],
		['id' => 2, 'name' => 'Greg Mayer'],
		['id' => 3, 'name' => 'Dexter Leffler'],
		['id' => 4, 'name' => 'Amanda Yost'],
		['id' => 5, 'name' => 'Dustin Marquardt'],
		['id' => 6, 'name' => 'Lee Morar'],
		['id' => 7, 'name' => 'Ms. Elsie Jerde'],
		['id' => 8, 'name' => 'Angel Cole I'],
		['id' => 9, 'name' => 'Wilma Glover DVM'],
		['id' => 10, 'name' => 'Kerry Hackett']
	];

	private $dummyCustomerAddress = [
		['name' => 'casa', 'customers_id' => 1, 'addresses_id' => 1],
		['name' => 'casa', 'customers_id' => 2, 'addresses_id' => 2],
		['name' => 'casa', 'customers_id' => 3, 'addresses_id' => 3],
		['name' => 'casa', 'customers_id' => 4, 'addresses_id' => 4],
		['name' => 'casa', 'customers_id' => 5, 'addresses_id' => 5],
		['name' => 'casa', 'customers_id' => 6, 'addresses_id' => 6],
		['name' => 'casa', 'customers_id' => 7, 'addresses_id' => 7],
		['name' => 'casa', 'customers_id' => 8, 'addresses_id' => 8],
		['name' => 'casa', 'customers_id' => 9, 'addresses_id' => 9],
		['name' => 'casa', 'customers_id' => 10, 'addresses_id' => 10]
	];

	private $dummySuppliers = [
		['id' => 1, 'name' => 'Winston Romaguera', 'range' => 3.5],
		['id' => 2, 'name' => 'Dr. Blanca Kilback', 'range' => 5],
		['id' => 3, 'name' => 'Eileen Feeney', 'range' => 3],
		['id' => 4, 'name' => 'Ed Kreiger', 'range' => 4],
		['id' => 5, 'name' => 'Geoffrey Greenholt', 'range' => 6],
		['id' => 6, 'name' => 'Ms. Ora Streich', 'range' => 3.5],
		['id' => 7, 'name' => "Hugo O'Kon Sr.", 'range' => 1.5],
		['id' => 8, 'name' => 'Salvatore Yundt', 'range' => 2.5],
		['id' => 9, 'name' => 'Dorothy Emmerich', 'range' => 4],
		['id' => 10, 'name' => 'Michele McLaughlin', 'range' => 2.5]
	];

	private $dummySuppliersAddress = [
		['name' => 'casa', 'suppliers_id' => 1, 'addresses_id' => 1],
		['name' => 'casa', 'suppliers_id' => 2, 'addresses_id' => 2],
		['name' => 'casa', 'suppliers_id' => 3, 'addresses_id' => 3],
		['name' => 'casa', 'suppliers_id' => 4, 'addresses_id' => 4],
		['name' => 'casa', 'suppliers_id' => 5, 'addresses_id' => 5],
		['name' => 'casa', 'suppliers_id' => 6, 'addresses_id' => 6],
		['name' => 'casa', 'suppliers_id' => 7, 'addresses_id' => 7],
		['name' => 'casa', 'suppliers_id' => 8, 'addresses_id' => 8],
		['name' => 'casa', 'suppliers_id' => 9, 'addresses_id' => 9],
		['name' => 'casa', 'suppliers_id' => 10, 'addresses_id' => 10]
	];

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// insert addresses
		foreach ($this->dummyAddress as $add) {
			DB::table('addresses')->insert($add);
		}
		// insert custommers
		foreach ($this->dummyCustomers as $customer) {
			DB::table('customers')->insert($customer);
		}
		// insert customers_address
		foreach ($this->dummyCustomerAddress as $customerAdd) {
			DB::table('customers_addresses')->insert($customerAdd);
		}
		// insert suppliers
		foreach ($this->dummySuppliers as $supplier) {
			DB::table('suppliers')->insert($supplier);
		}
		// insert suppliers_address
		foreach ($this->dummySuppliersAddress as $supplierAdd) {
			DB::table('suppliers_addresses')->insert($supplierAdd);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}
}
