<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers_addresses', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 45);
			$table->unsignedInteger('suppliers_id');
			$table->foreign('suppliers_id')->references('id')->on('suppliers');
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
        Schema::dropIfExists('suppliers_addresses');
    }
}
