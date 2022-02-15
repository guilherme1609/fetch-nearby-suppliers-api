<?php

namespace App\Http\Controllers;

use App\Http\Domain\SupplierDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
	public function fetchAllNearbySuppliers()
	{
		$user = Auth::guard()->user();
		$customerId = $user->customer_id;
		$suppliersDomain = new SupplierDomain();
		$resSuppliers = $suppliersDomain->getAllSuppliers($customerId);

		if ($resSuppliers) {
			return response()->json(['status'=>'success', 'data'=>$resSuppliers]);
		}
		return response()->json(['status'=>'error', 'message'=>'Nenhum fornecedor encontrado!']);
	}
}
