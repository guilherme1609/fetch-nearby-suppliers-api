<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\AddressesInterface;
use App\Http\Domain\CustomersAddressesDomain;
use App\Models\CustomersAddresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersAddressesController extends Controller implements AddressesInterface
{
	public function index()
	{
		$user = Auth::guard()->user();
		$customerId = $user->customers_id;
		$customerAddressesDomain = new CustomersAddressesDomain();
		$res = $customerAddressesDomain->getCustomerAddresses($customerId);

		if ($res && count($res) > 0) {
			return response()->json(['status' => 'success', 'data' => $res]);
		} else if (!$res || count($res) == 0) {
			return response()->json(['status' => 'success', 'data' => $res, 'message' => 'Você ainda não possui um endereço cadastrado!']);
		} else {
			return response()->json(['status' => 'error', 'message' => 'Não foi possível carregar os endereços, por favor tente mais tarde!']);
		}
	}
	public function store(Request $request)
	{
		try {
			$customersAddresses = new CustomersAddresses();
			$user = Auth::guard()->user();
			$customersAddresses->customers_id = $user->customers_id;
			$customersAddresses->name = $request->post('name');
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
			$user = Auth::guard()->user();
			$customersAddresses->customers_id = $user->customers_id;
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
