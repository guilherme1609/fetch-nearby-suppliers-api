<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    //
	protected function respondWithToken($token)
	{
		return response()->json([
			'token'=>$token,
			'token_type'=>'bearer',
			'expires_id'=>Auth::factory()->getTTL() * 120
		], 200);
	}
}
