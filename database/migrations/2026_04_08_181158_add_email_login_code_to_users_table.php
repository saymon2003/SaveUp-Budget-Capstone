<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_login_code')->nullable()->after('remember_token');
            $table->timestamp('email_login_code_expires_at')->nullable()->after('email_login_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email_login_code', 'email_login_code_expires_at']);
        });
    }
};