<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitIdToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('unit_id')->after('area')->nullable();
        
        });
        Schema::table('property_drafts', function (Blueprint $table) {
            $table->string('unit_id')->after('area')->nullable();
        
        });
        Schema::table('property_requirement_drafts', function (Blueprint $table) {
            $table->string('unit_id')->after('min_area')->nullable();
        
        });
        Schema::table('property_requirements', function (Blueprint $table) {
            $table->string('unit_id')->after('min_area')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('unit_id');

        });
    }
}
