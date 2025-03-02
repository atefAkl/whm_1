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
        // Update orders table foreign key
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['user_id']);
            
            // Rename the column to maintain consistency but keep using admin_id internally
            $table->renameColumn('user_id', 'admin_id');
            
            // Add the new foreign key
            $table->foreign('admin_id')->references('id')->on('admins');
        });

        // Drop the users table as we're consolidating to admins table
        Schema::dropIfExists('users');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Revert orders table changes
        Schema::table('orders', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['admin_id']);
            
            // Rename back to user_id
            $table->renameColumn('admin_id', 'user_id');
            
            // Add back the original foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
};
