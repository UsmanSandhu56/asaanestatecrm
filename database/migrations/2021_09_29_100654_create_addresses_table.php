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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text('street_address');
            $table->string('country');
            $table->string('location');
            $table->float('latitude', 11, 7)->nullable();
            $table->float('longitude', 11, 7)->nullable();
            $table->string('city');
            $table->string('sublocality_level_1')->nullable();
            $table->string('sublocality_level_2')->nullable();
            $table->string('sublocality_level_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
