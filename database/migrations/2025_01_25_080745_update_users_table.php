<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Change the 'id' column to a string
            //$table->string('id')->unique()->change();

            // Add a new 'usertype' column as a string
            //$table->string('usertype')->nullable()->after('email');
            // Add a new 'usertype' column as a string
            $table->string('username')->nullable()->after('email');
            // Make 'email' nullable
            //$table->string('email')->nullable()->change();
            // Make 'name' nullable
            //$table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            // Revert 'id' back to an integer (or the original type)
            $table->integer('id')->change();

            // Drop the 'usertype' column
            #$table->dropColumn('usertype');
            // Make 'email' non-nullable again
            //$table->string('email')->nullable(false)->change();

            // Make 'name' non-nullable again
            //$table->string('name')->nullable(false)->change();
        });
    }
};
