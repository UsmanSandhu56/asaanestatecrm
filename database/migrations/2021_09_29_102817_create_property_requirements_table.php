<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('purpose')->nullable()->comment('0 for buy and 1 for rent');
            $table->tinyInteger('urgency')->comment('0 === immediate 1 === 2-3 weeks 2===1+month');
            $table->unsignedDouble('max_price');
            $table->unsignedDouble('min_price');
            $table->unsignedDouble('max_area');
            $table->unsignedDouble('min_area');
            $table->boolean('is_serious')->default(false);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('agency_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('sub_category_id')->constrained();
            $table->foreignId('property_requirement_detail_id')->constrained();
            $table->foreignId('status_id')->nullable()->constrained();
            $table->foreignId('status_reasons_id')->nullable()->constrained();
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
        Schema::dropIfExists('property_requirements');
    }
}
