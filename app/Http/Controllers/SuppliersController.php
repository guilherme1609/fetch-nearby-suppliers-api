<?php

namespace App\Http\Controllers;

use App\Http\Infra\SuppliersRepository;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function fetchSuppliers(Request $request)
	{
		$suppliersData = App()->make('App\Http\Infra\SuppliersRepository')
			->fetchNearbySuppliers($request->get('latitude'), $request->get('longitude'));
		if ($suppliersData) {
			return response()->json(['status'=>'success', 'data'=> $suppliersData]);
		}
		return response()->json(['status'=>'error', 'message'=>'Desculpe! Ainda não temos um fornecedor perto de você.']);
	}
}
