<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\AddressesInterface;
use App\Models\CustomersAddresses;
use Illuminate\Http\Request;

class CustomersAddressesController extends Controller implements AddressesInterface
{
	public function index()
	{
		// $customerId = pegar da sessao
		$res = App()->make('App\Http\Infra\CustomersAddressesRepository')
			->fetchCustomerAddresses(1);

		if ($res && count($res) > 0) {
			return response()->json(['status' => 'success', 'data' => $res]);
		} else if ($res && count($res) == 0) {
			return response()->json(['status' => 'success', 'data' => $res, 'message' => 'Você ainda não possui um endereço cadastrado!']);
		} else {
			return response()->json(['status' => 'error', 'message' => 'Não foi possível carregar os endereços, por favor tente mais tarde!']);
		}
	}
	public function store(Request $request)
	{
		try {
			$customersAddresses = new CustomersAddresses();
			$customersAddresses->customers_id = 1; // Mudar para id da sessao
			$customersAddresses->name = $request->post('name'); // Mudar para id da sessao
			$customersAddresses->addresses_id = $request->post('addresses_id');
			if ($customersAddresses->save()) {
				return response()->json(['status' => 'success', 'message' => 'Endereço cadastrado!']);
			}
		} catch (\Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
	public function update(Request $request, $id)
	{
		try {
			$customersAddresses = CustomersAddresses::findOrFail($id);
			$customersAddresses->customers_id = 1; // Mudar para id da sessao
			$customersAddresses->name = $request->post('name');
			$customersAddresses->addresses_id = $request->post('addresses_id');
			if ($customersAddresses->save()) {
				return response()->json(['status' => 'success', 'message' => 'Endereço alterado!']);
			}
		} catch (\Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
	public function delete($id)
	{
		try {
            $customersAddresses = CustomersAddresses::findOrFail($id);
            if ($customersAddresses->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Endereço deletado!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
	}
}
