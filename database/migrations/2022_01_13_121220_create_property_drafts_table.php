<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_drafts', function (Blueprint $table) {
            $table->id();
            $table->integer('auth_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable()->nullable();
            $table->tinyInteger('urgency')->comment('1 === immediate 0 === 2-3 weeks 2===1+month')->nullable();
            $table->tinyInteger('purpose')->comment('0 for sell and 1 for rent')->nullable();
            $table->unsignedDouble('area')->nullable();
            $table->unsignedDouble('price')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('agency_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->foreignId('property_detail_id')->nullable()->constrained('property_details');
            $table->foreignId('address_id')->nullable();
            $table->foreignId('status_id')->nullable()->nullable();
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
        Schema::dropIfExists('property_drafts');
    }
}
