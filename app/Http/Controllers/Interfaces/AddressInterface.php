<?php
namespace App\Http\Controllers\Interfaces;

use Illuminate\Http\Request;

interface AddressInterface
{
	public function index();
	public function store(Request $request);
	public function update(Request $request, $id);
	public function delete($id);
}
