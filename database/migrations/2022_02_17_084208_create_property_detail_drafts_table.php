<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDetailDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_detail_drafts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rooms')->nullable();
            $table->unsignedBigInteger('bathrooms')->nullable();
            $table->integer('parking_space')->nullable();
            $table->string('year_build')->nullable();
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
        Schema::dropIfExists('property_detail_drafts');
    }
}
