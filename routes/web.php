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
		$router->options('/fetch-nearby', 'SuppliersController@fetchSuppliers');
		$router->get('/fetch-nearby', 'SuppliersController@fetchSuppliers');
	});

	$router->group(['middleware' => ['CorsDomain', 'auth:api'], 'prefix' => '/address'], function () use ($router) {
		// Search for address
		$router->options('/search-addresses', 'AddressesController@searchAddresses');
		$router->get('/search-addresses', 'AddressesController@searchAddresses');
	});

	// Customers addresses group
	$router->group(['middleware' => ['CorsDomain', 'auth:api'], 'prefix' => '/customers'], function () use ($router) {

		$router->options('/addresses', 'CustomersAddressesController@index');
		$router->get('/addresses', 'CustomersAddressesController@index');

		$router->options('/store', 'CustomersAddressesController@store');
		$router->post('/store', 'CustomersAddressesController@store');
		// Fetch all suppliers of customer
		$router->options('/suppliers', 'CustomersController@fetchAllNearbySuppliers');
		$router->get('/suppliers', 'CustomersController@fetchAllNearbySuppliers');

		$router->options('/update/{id}', 'CustomersAddressesController@update');
		$router->put('/update/{id}', 'CustomersAddressesController@update');

		$router->options('/delete/{id}', 'CustomersAddressesController@delete');
		$router->delete('/delete/{id}', 'CustomersAddressesController@delete');
	});
});
