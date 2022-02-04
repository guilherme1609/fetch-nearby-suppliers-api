<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/* Deve conter uma rota que retorne o cliente com os fornecedores que o atendem */

$router->group(['prefix' => 'api'], function () use ($router) {

	$router->group(['prefix' => 'auth'], function () use ($router) {
		$router->post('/register', 'UserController@register');
		$router->post('/login', 'UserController@login');
		$router->get('/me', 'UserController@me');
		$router->post('/logout', 'UserController@logout');
	});

	$router->group(['middleware' => 'auth:api', 'prefix' => '/suppliers'], function () use ($router) {
		// Search for nearby suppliers
		$router->get('/fetch-nearby', 'SuppliersController@fetchSuppliers');
	});

	$router->group(['middleware' => 'auth:api', 'prefix' => '/address'], function () use ($router) {
		// Search for address
		$router->get('/search-addresses', 'AddressesController@searchAddresses');
	});

	// Customers addresses group
	$router->group(['middleware' => 'auth:api', 'prefix' => '/customers'], function () use ($router) {
		$router->get('/addresses', 'CustomersAddressesController@index');
		$router->post('/store', 'CustomersAddressesController@store');
		$router->put('/update/{id}', 'CustomersAddressesController@update');
		$router->delete('/delete/{id}', 'CustomersAddressesController@delete');
	});
});
