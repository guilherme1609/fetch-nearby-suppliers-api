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
        Schema::create('customer_address', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 45);
			$table->smallInteger('main_address')->default(0);
			$table->unsignedInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customer');
			$table->unsignedInteger('address_id');
			$table->foreign('address_id')->references('id')->on('address');
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
        Schema::dropIfExists('customer_address');
    }
}
