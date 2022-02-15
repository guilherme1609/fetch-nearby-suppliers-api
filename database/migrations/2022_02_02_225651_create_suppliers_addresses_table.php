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
        Schema::create('supplier_address', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name', 45);
			$table->unsignedInteger('supplier_id');
			$table->foreign('supplier_id')->references('id')->on('supplier');
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
        Schema::dropIfExists('supplier_address');
    }
}
