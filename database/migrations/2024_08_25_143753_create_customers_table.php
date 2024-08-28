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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('budget')->nullable();
            $table->string('status')->default(1);
            $table->text('problem')->nullable();
            $table->dateTime('follow_up_date')->nullable();
            $table->integer('user_id');
            $table->text('note')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable(); 
            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
