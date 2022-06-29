<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPropertyDetailToPropertyDraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_drafts', function (Blueprint $table) {
            $table->dropForeign('property_drafts_property_detail_id_foreign');
            $table->dropColumn('property_detail_id');
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
            //
        });
    }
}
