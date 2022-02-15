<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
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
		['name' => 'Loja 1', 'customer_id' => 1, 'address_id' => 1],
		['name' => 'Loja 2', 'customer_id' => 2, 'address_id' => 2],
		['name' => 'Loja 3', 'customer_id' => 3, 'address_id' => 3],
		['name' => 'Loja 4', 'customer_id' => 4, 'address_id' => 4],
		['name' => 'Loja 5', 'customer_id' => 5, 'address_id' => 5],
		['name' => 'Loja 6', 'customer_id' => 6, 'address_id' => 6],
		['name' => 'Loja 7', 'customer_id' => 7, 'address_id' => 7],
		['name' => 'Loja 8', 'customer_id' => 8, 'address_id' => 8],
		['name' => 'Loja 9', 'customer_id' => 9, 'address_id' => 9],
		['name' => 'Loja 10','customer_id' => 10, 'address_id' => 9],
		['name' => 'Loja 11','customer_id' => 10, 'address_id' => 8],
		['name' => 'Loja 12','customer_id' => 10, 'address_id' => 10]
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
		['name' => 'Centro de distribuição 1', 'supplier_id' => 1, 'address_id' => 1],
		['name' => 'Centro de distribuição 2', 'supplier_id' => 2, 'address_id' => 2],
		['name' => 'Centro de distribuição 3', 'supplier_id' => 3, 'address_id' => 3],
		['name' => 'Centro de distribuição 4', 'supplier_id' => 4, 'address_id' => 4],
		['name' => 'Centro de distribuição 5', 'supplier_id' => 5, 'address_id' => 5],
		['name' => 'Centro de distribuição 6', 'supplier_id' => 6, 'address_id' => 6],
		['name' => 'Centro de distribuição 7', 'supplier_id' => 7, 'address_id' => 7]
	];

	private function createUser()
	{
		DB::table('users')->insert([
			'email' => 'usuariophpunit@phpunit.com',
			'password' => Hash::make('123456789'),
			'customer_id'=>10,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s')
		]);
	}

    public function run()
    {
        // insert address
		foreach ($this->dummyAddress as $add) {
			DB::table('address')->insert($add);
		}
		// insert custommers
		foreach ($this->dummyCustomers as $customer) {
			DB::table('customer')->insert($customer);
		}
		// insert customers_address
		foreach ($this->dummyCustomerAddress as $customerAdd) {
			DB::table('customer_address')->insert($customerAdd);
		}
		// insert suppliers
		foreach ($this->dummySuppliers as $supplier) {
			DB::table('supplier')->insert($supplier);
		}
		// insert suppliers_address
		foreach ($this->dummySuppliersAddress as $supplierAdd) {
			DB::table('supplier_address')->insert($supplierAdd);
		}

		$this->createUser();
    }
}
