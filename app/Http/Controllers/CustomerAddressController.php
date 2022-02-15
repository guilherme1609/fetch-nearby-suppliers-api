<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\AddressInterface;
use App\Http\Domain\CustomerAddressDomain;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAddressController extends Controller implements AddressInterface
{
	public function index()
	{
		$user = Auth::guard()->user();
		$customerId = $user->customer_id;
		$customerAddressesDomain = new CustomerAddressDomain();
		$res = $customerAddressesDomain->getCustomerAddresses($customerId);

		if ($res && count($res) > 0) {
			return response()->json(['status' => 'success', 'customerAddresses' => $res]);
		} else if (!$res || count($res) == 0) {
			return response()->json(['status' => 'success', 'customerAddresses' => $res, 'message' => 'Você ainda não possui um endereço cadastrado!']);
		} else {
			return response()->json(['status' => 'error', 'message' => 'Não foi possível carregar os endereços, por favor tente mais tarde!']);
		}
	}
	public function store(Request $request)
	{
		try {
			$customersAddresses = new CustomerAddress();
			$user = Auth::guard()->user();
			$customersAddresses->customer_id = $user->customer_id;
			$customersAddresses->name = $request->post('name');
			$customersAddresses->address_id = $request->post('address_id');
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
			$customersAddresses = CustomerAddress::findOrFail($id);
			$user = Auth::guard()->user();
			$customersAddresses->customer_id = $user->customer_id;
			$customersAddresses->name = $request->post('name');
			$customersAddresses->address_id = $request->post('address_id');
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
            $customersAddresses = CustomerAddress::findOrFail($id);
            if ($customersAddresses->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Endereço deletado!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
	}
}
