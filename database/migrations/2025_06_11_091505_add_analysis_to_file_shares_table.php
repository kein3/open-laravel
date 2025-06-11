<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('file_shares', function (Blueprint $table) {
        $table->json('analysis_json')->nullable();
        $table->text('analysis_raw')->nullable();
    });
}

public function down()
{
    Schema::table('file_shares', function (Blueprint $table) {
        $table->dropColumn(['analysis_json', 'analysis_raw']);
    });
}

    
};
