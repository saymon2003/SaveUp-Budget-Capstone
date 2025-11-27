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
    Schema::create('goal_transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('goal_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->enum('type', ['add', 'remove']); 
        $table->decimal('amount', 10, 2);

        $table->date('date');
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('goal_transactions');
}

};
