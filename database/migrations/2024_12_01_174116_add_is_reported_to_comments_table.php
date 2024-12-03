<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method adds a new column 'is_reported' to the 'comments' table.
     */
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            if (!Schema::hasColumn('comments', 'is_reported')) {
                $table->boolean('is_reported')
                    ->default(false)
                    ->after('content')
                    ->comment('Indicates if the comment has been reported');
            }
        });
    }

    /**
     * Reverse the migrations.
     * This method removes the 'is_reported' column from the 'comments' table.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            if (Schema::hasColumn('comments', 'is_reported')) {
                $table->dropColumn('is_reported');
            }
        });
    }
};
