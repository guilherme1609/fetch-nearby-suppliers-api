<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/* Deve conter uma rota que retorne o cliente com os fornecedores que o atendem */

$router->group(['prefix' => 'api'], function () use ($router) {

	$router->group(['middleware' => ['CorsDomain'], 'prefix' => 'auth'], function () use ($router) {
		$router->options('/register', 'UserController@register');
		$router->post('/register', 'UserController@register');

		$router->options('/login', 'UserController@login');
		$router->post('/login', 'UserController@login');

		$router->options('/me', 'UserController@me');
		$router->get('/me', 'UserController@me');

		$router->options('/logout', 'UserController@logout');
		$router->post('/logout', 'UserController@logout');
	});

	$router->group(['middleware' => ['CorsDomain', 'auth:api'], 'prefix' => '/suppliers'], function () use ($router) {
		// Search for nearby suppliers
		$router->options('/fetch-nearby', 'SupplierController@fetchSuppliers');
		$router->get('/fetch-nearby', 'SupplierController@fetchSuppliers');
	});

	$router->group(['middleware' => ['CorsDomain', 'auth:api'], 'prefix' => '/address'], function () use ($router) {
		// Search for address
		$router->options('/search-addresses', 'AddressController@searchAddresses');
		$router->get('/search-addresses', 'AddressController@searchAddresses');
	});

	// Customers addresses group
	$router->group(['middleware' => ['CorsDomain', 'auth:api'], 'prefix' => '/customers'], function () use ($router) {

		$router->options('/addresses', 'CustomerAddressController@index');
		$router->get('/addresses', 'CustomerAddressController@index');

		$router->options('/store', 'CustomerAddressController@store');
		$router->post('/store', 'CustomerAddressController@store');
		// Fetch all suppliers of customer
		$router->options('/suppliers', 'CustomerController@fetchAllNearbySuppliers');
		$router->get('/suppliers', 'CustomerController@fetchAllNearbySuppliers');

		$router->options('/update/{id}', 'CustomerAddressController@update');
		$router->put('/update/{id}', 'CustomerAddressController@update');

		$router->options('/delete/{id}', 'CustomerAddressController@delete');
		$router->delete('/delete/{id}', 'CustomerAddressController@delete');
	});
});
