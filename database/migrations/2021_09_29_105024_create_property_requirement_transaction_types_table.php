<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRequirementTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_requirement_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_req_id')->constrained('property_requirements');
            $table->foreignId('trans_type_id')->constrained('transaction_types');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('agency_id')->constrained();
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
        Schema::dropIfExists('property_requirement_transaction_types');
    }
}
