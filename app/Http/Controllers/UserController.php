<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\User;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'register']]);
	}

	public function register(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed'
		]);

		try {

			$customers = new Customers();
			$customers->name = $request->post('name');
			if ($customers->save()) {
				$user = new User();
				$user->email = $request->post('email');
				$plainPassword = $request->post('password');
				$user->password = app('hash')->make($plainPassword);
				$user->customers_id = $customers->id;
				if ($user->save()) {
					return response()->json(['status' => 'success', 'message' => 'Usuario registrado!'], 201);
				}
			}
		} catch (\Exception $e) {
			return response()->json(['status' => 'error', 'message' => 'User Registration Failed!'], 409);
		}
	}

	public function login(Request $request)
	{
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required'
		], [
			'email.required' => 'Informe seu e-mail.',
			'password.required' => 'Informe sua senha.'
		]);

		$input = $request->only('email', 'password');

		$authorized = Auth::attempt($input);
		if (!$authorized) {
			return response()->json(['status' => 'error', 'message' => 'Usário não autorizado'], 401);
		} else {
			$token = $this->respondWithToken($authorized);
			return response()->json([
				'status' => 'success',
				'message' => 'Usuário logado com successo!',
				'token' => $token
			], 200);
		}
	}

	public function me()
	{
		$user = $this->guard()->user();
		$customer = DB::table('customers')->select('name')->whereNull('deleted_at')->where('id', $user->customers_id)->first()->name;
		if ($user && $customer) {
			$data = [
				'id' => $user->id,
				'name' => $customer,
				'email' => $user->email,
				'customer_id' => $user->customers_id
			];

			return response()->json(['status' => 'success', 'data' => $data]);
		}
		return response()->json(['status' => 'error', 'message' => 'Usuário não autenticado!'], 401);
	}

	public function logout()
	{
		Auth::guard()->logout();
		return response()->json(['status'=>'success','message'=>'Logged out!']);
	}

	public function guard()
	{
		return Auth::guard();
	}
}
