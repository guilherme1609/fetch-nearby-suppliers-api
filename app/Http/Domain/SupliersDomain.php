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
		$allSuppliers = $this->fetchAllNearbySuppliers($customerId);
		if ($allSuppliers) {

			foreach ($allSuppliers as $i => $supplier) {
				$customerData[$supplier->customerAddress] = [
					'id' => $supplier->idCustomer,
					'name' => $supplier->customer,
					'addressName' => $supplier->addressName
				];

				$suppliersData[] = [
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
		}
		$res = array_values($customerData);
		$res[0]['suppliers'] = $suppliersData;
		return $res;
	}
}
