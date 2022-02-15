<?php

namespace App\Http\Domain;

use App\Http\Infra\SupplierRepository;

class SupplierDomain extends SupplierRepository
{
	public function getNearbySuppliers($latitude, $longitude)
	{
		if (!$latitude || !$longitude) {
			return false;
		}
		return $this->fetchNearbySuppliers($latitude, $longitude);
	}
	public function getAllSuppliersOfCustomer($customerId)
	{
		if (!$customerId) return false;
		$customerSupplier = [];
		$suppliers = [];
		$allSuppliers = $this->fetchAllNearbySuppliers($customerId);
		if (!$allSuppliers) return false;
		foreach ($allSuppliers as $supplier) {
			$customerSupplier[$supplier->customerAddress] = [
				'id' => $supplier->customerAddress,
				'name' => $supplier->addressName,
				'customer' => [
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
			$suppliers[$supplier->customerAddress][] = [
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
			$customerSupplier[$supplier->customerAddress]['suppliers'] = array_values($suppliers)[0];
		}
		return array_values($customerSupplier);
	}
}
