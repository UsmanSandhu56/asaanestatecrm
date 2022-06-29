<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRequirementDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_requirement_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable()->nullable();
            $table->tinyInteger('purpose')->nullable()->comment('0 for buy and 1 for rent')->nullable();
            $table->tinyInteger('urgency')->comment('0 === immediate 1 === 2-3 weeks 2===1+month')->nullable();
            $table->unsignedDouble('max_price')->nullable();
            $table->unsignedDouble('min_price')->nullable();
            $table->unsignedDouble('max_area')->nullable();
            $table->unsignedDouble('min_area')->nullable();
            $table->boolean('is_serious')->default(false)->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('agency_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('sub_category_id')->nullable();
            $table->foreignId('property_requirement_detail_id')->nullable();
            $table->foreignId('status_id')->nullable();
            $table->foreignId('status_reasons_id')->nullable()->nullable();
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
        Schema::dropIfExists('property_requirement_drafts');
    }
}
