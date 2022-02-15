<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
			$table->string('street', 150)->nullable();
			$table->string('number', 10)->nullable();
			$table->string('postal_code', 20)->nullable();
			$table->string('neighborhood', 100)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('state', 2)->nullable();
			$table->string('country', 2)->nullable();
			$table->decimal('lat', 9, 7);
			$table->decimal('long', 16, 14);

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
        Schema::dropIfExists('addresses');
    }
}
