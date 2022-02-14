<?php

namespace App\Http\Domain;

use App\Http\Infra\SuppliersRepository;

class SuppliersDomain extends SuppliersRepository
{
	/*
		Fetch all nearby suppliers by $latitude, $longitude
	*/
	public function getNearbySuppliers($latitude, $longitude)
	{
		if (!$latitude || !$longitude) {
			return false;
		}
		return $this->fetchNearbySuppliers($latitude, $longitude);
	}
	/*
		Return all suppliers for customer logged
	*/
	public function getAllSuppliers($customerId)
	{
		if (!$customerId) {
			return false;
		}
		$customerSupplierAddress = [];
		$suppliersData = [];
		$suppliers = [];
		$allSuppliers = $this->fetchAllNearbySuppliers($customerId);
		if ($allSuppliers) {

			foreach ($allSuppliers as $i => $supplier) {

				$customerSupplierAddress[$supplier->customerAddress] = [
					'id' => $supplier->customerAddress,
					'name' => $supplier->addressName,
					'customer'=>[
						'id' => $supplier->idCustomer,
						'name' => $supplier->customer,
						'address' => $supplier->address,
						'street' => $supplier->customer_street,
						'number' => $supplier->customer_number,
						'postal_code' => $supplier->customer_postal_code,
						'neighborhood' => $supplier->customer_neighborhood,
						'city' => $supplier->customer_city,
						'state' => $supplier->customer_state,
						'country' => $supplier->customer_country,
						'lat' => $supplier->customer_lat,
						'long' => $supplier->customer_long
					]
				];

				$suppliersData[$supplier->customerAddress][] = [
					'id' => $supplier->idSupplier,
					'name' => $supplier->supplier,
					'range' => $supplier->range,
					'street' => $supplier->street,
					'number' => $supplier->number,
					'postal_code' => $supplier->postal_code,
					'neighborhood' => $supplier->neighborhood,
					'city' => $supplier->city,
					'state' => $supplier->state,
					'country' => $supplier->country,
					'lat' => $supplier->lat,
					'long' => $supplier->long
				];
			}

			// Cleaner array, reset index
			foreach ($customerSupplierAddress as $i => $customer) {
				$suppliers[] = [
					'id'=>$customer['id'],
					'name'=>$customer['name'],
					'customer'=>[
						'name'=>$customer['customer']['name'],
						'address'=>$customer['customer']['address'],
						'street' => $customer['customer']['street'],
						'number' => $customer['customer']['number'],
						'postal_code' => $customer['customer']['postal_code'],
						'neighborhood' => $customer['customer']['neighborhood'],
						'city' => $customer['customer']['city'],
						'state' => $customer['customer']['state'],
						'country' => $customer['customer']['country'],
						'lat' => $customer['customer']['lat'],
						'long' => $customer['customer']['long'],
					],
					'suppliers'=>$suppliersData[$i]
				];
			}
		}
		return $suppliers;
	}
}
