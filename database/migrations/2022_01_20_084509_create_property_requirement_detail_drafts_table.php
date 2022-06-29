<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRequirementDetailDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_requirement_detail_drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('agency_id')->nullable();
            $table->unsignedBigInteger('max_rooms')->nullable();
            $table->unsignedBigInteger('min_rooms')->nullable();
            $table->unsignedBigInteger('max_bathrooms')->nullable();
            $table->unsignedBigInteger('min_bathrooms')->nullable();
            $table->integer('parking_space')->nullable();
            $table->string('year_build')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->float('latitude', 11, 7)->nullable();
            $table->float('longitude', 11, 7)->nullable();
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
        Schema::dropIfExists('property_requirement_detail_drafts');
    }
}
