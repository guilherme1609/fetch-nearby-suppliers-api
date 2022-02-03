<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/* Deve conter uma rota que retorne o cliente com os fornecedores que o atendem */

$router->group(['prefix' => 'api'], function () use ($router) {

	$router->group(['prefix' => '/suppliers'], function () use ($router) {
		// Search for nearby suppliers
		$router->get('/fetch-nearby', 'SuppliersController@fetchSuppliers');
	});

	$router->group(['prefix' => '/address'], function () use ($router) {
		// Search for address
		$router->get('/fetch-address', 'AddressesController@fetchAddress');
	});

	// Customers addresses group
	$router->group(['prefix' => '/customers'], function () use ($router) {
		$router->get('/addresses', 'CustomersAddressesController@index');
		$router->post('/store', 'CustomersAddressesController@store');
		$router->put('/update/{id}', 'CustomersAddressesController@update');
		$router->delete('/delete/{id}', 'CustomersAddressesController@delete');
	});
});
