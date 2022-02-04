<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressesController extends Controller
{
	public function searchAddresses(Request $request)
	{
		$address = $request->get('address');
		// Av. N. Sra. Aparecida, 582, Curitiba, PR
		if (!$address || count(explode(',', $address)) != 4) {
			return response()->json([
				'status' => 'error',
				'message' => 'É preciso informar um endereço válido no formato: Rua, numero, cidade, estado.'
			]);
		}
		$res = App()->make('App\Http\Infra\AddressesRepository')->fetchAddress($address);
		if (!$res) {
			return response()->json([
				'status' => 'error',
				'message' => 'Desculpe não conseguimos localizar o seu endereço, verifique se está correto!'
			]);
		} else {
			return response()->json(['status' => 'success', 'data' => $res]);
		}
	}
}
