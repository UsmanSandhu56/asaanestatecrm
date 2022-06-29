<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyDetailToPropertyDraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_drafts', function (Blueprint $table) {        
            $table->foreignId('property_detail_draft_id')->after('auth_id')->nullable()->constrained('property_detail_drafts');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_drafts', function (Blueprint $table) {
            $table->dropForeign(['property_detail_draft_id']);
            $table->dropColumn('property_detail_draft_id');
        });
    }
}
