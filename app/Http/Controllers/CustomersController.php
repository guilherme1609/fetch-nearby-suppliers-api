<?php

namespace App\Http\Controllers;

use App\Http\Domain\SuppliersDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
	public function fetchAllNearbySuppliers()
	{
		$user = Auth::guard()->user();
		$customerId = $user->customers_id;
		$suppliersDomain = new SuppliersDomain();
		$resSuppliers = $suppliersDomain->getAllSuppliers($customerId);

		if ($resSuppliers) {
			return response()->json(['status'=>'success', 'data'=>$resSuppliers]);
		}
		return response()->json(['status'=>'error', 'message'=>'Nenhum fornecedor encontrado!']);
	}
}
