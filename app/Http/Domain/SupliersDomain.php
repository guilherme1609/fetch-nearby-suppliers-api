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
		$customerData = [];
		$suppliersData = [];
		$suppliers = [];
		$allSuppliers = $this->fetchAllNearbySuppliers($customerId);
		if ($allSuppliers) {

			foreach ($allSuppliers as $i => $supplier) {
				$customerData[$supplier->customerAddress] = [
					'id' => $supplier->customerAddress,
					'idCustomer' => $supplier->idCustomer,
					'name' => $supplier->customer,
					'addressName' => $supplier->addressName,
					'address' => $supplier->address,
					'customer_street' => $supplier->customer_street,
					'customer_number' => $supplier->customer_number,
					'customer_postal_code' => $supplier->customer_postal_code,
					'customer_neighborhood' => $supplier->customer_neighborhood,
					'customer_city' => $supplier->customer_city,
					'customer_state' => $supplier->customer_state,
					'customer_country' => $supplier->customer_country,
					'customer_lat' => $supplier->customer_lat,
					'customer_long' => $supplier->customer_long
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

			foreach ($customerData as $i => $customer) {
				$suppliers[] = [
					'id'=>$customer['id'],
					'idCustomer'=>$customer['idCustomer'],
					'name'=>$customer['name'],
					'addressName'=>$customer['addressName'],
					'address'=>$customer['address'],
					'street' => $customer['customer_street'],
					'number' => $customer['customer_number'],
					'postal_code' => $customer['customer_postal_code'],
					'neighborhood' => $customer['customer_neighborhood'],
					'city' => $customer['customer_city'],
					'state' => $customer['customer_state'],
					'country' => $customer['customer_country'],
					'lat' => $customer['customer_lat'],
					'long' => $customer['customer_long'],
					'suppliers'=>$suppliersData[$i]
				];
			}
		}
		return $suppliers;
	}
}
