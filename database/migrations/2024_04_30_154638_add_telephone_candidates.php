<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //add telephone to candidates table
        Schema::table('candidates', function (Blueprint $table) {
            $table->string('telephone_number')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //drop column telephone from table candidates
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('telephone_number');
        });
    }
};
