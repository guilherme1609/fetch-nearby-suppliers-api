<?php

namespace App\Http\Controllers;

use App\Http\Domain\SupplierDomain;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function fetchSuppliers(Request $request)
	{
		$suppliersDomain = new SupplierDomain();
		$suppliersData = $suppliersDomain->getNearbySuppliers($request->get('latitude'), $request->get('longitude'));
		if ($suppliersData) {
			return response()->json(['status'=>'success', 'data'=> $suppliersData]);
		}
		return response()->json(['status'=>'error', 'message'=>'Desculpe! Ainda não temos um fornecedor perto de você.']);
	}
}
