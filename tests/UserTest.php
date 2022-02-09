<?php

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
	public $faker;
    /**
     * A basic test example.
     *
     * @return void
     */
	private function login()
	{
		$login = [
			'email'=>'usuariophpunit@phpunit.com',
			'password'=>'123456789'
		];

		$this->post('api/auth/login', $login);
		$response = (array) json_decode($this->response->content(), true);
		if ($response) {
			$this->token = $response['token']['original']['token'];
		}
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Login efetuado!');
	}

	private function loginUnknownUser()
	{
		$login = [
			'email'=>'usuariophpunitunknown@phpunit.com',
			'password'=>'123456789'
		];
		$this->post('api/auth/login', $login);
		$response = (array) json_decode($this->response->content());
		$this->assertResponseStatus(401);
		$this->assertEquals($response['status'], 'error', 'Usuario não encontrado!');
	}

	private function me()
	{
		// Dados do usuario logado
		$this->get('api/auth/me', ['Authorization'=>'Bearer '.$this->token]);
		$response = (array) json_decode($this->response->content());
		$this->assertResponseOk();
		$this->assertEquals($response['status'], 'success', 'Dados usuário!');
	}

	private function registerUser()
	{
		$this->email = $this->faker->unique()->safeEmail;
		$data = [
			'name'=>$this->faker->name(),
			'email' => $this->email,
			'password'=> '123456789',
			'password_confirmation'=> '123456789',
			'customers_id'=>$this->faker->numberBetween(1,10)
		];

		$this->post('api/auth/register', $data);
		$response = (array) json_decode($this->response->content());
		$this->assertResponseStatus(201);
		$this->assertEquals($response['status'], 'success', 'Register user test');
	}

    public function testExample()
    {
		$this->registerUser();
		$this->login();
		$this->me();
		$this->loginUnknownUser();
    }
}
