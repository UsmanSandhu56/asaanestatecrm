<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('property_requirement_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedDouble('amount');
            $table->unsignedDouble('agency_commission');
            $table->unsignedDouble('agent_commission');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('agency_id')->constrained();
            $table->boolean('is_confirmed')->default(0)->comment('0 for deal is not confirm and 1 for confirmed');
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
        Schema::dropIfExists('property_deals');
    }
}
