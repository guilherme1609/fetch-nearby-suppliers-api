<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_addresses', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 45);
			$table->unsignedInteger('customers_id');
			$table->foreign('customers_id')->references('id')->on('customers');
			$table->unsignedInteger('addresses_id');
			$table->foreign('addresses_id')->references('id')->on('addresses');
			$table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_addresses');
    }
}
