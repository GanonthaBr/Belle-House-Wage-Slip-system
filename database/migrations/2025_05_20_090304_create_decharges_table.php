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
        Schema::create('decharges', function (Blueprint $table) {
            $table->id();
            $table->decimal('number')->nullable();
            $table->string('name')->nullable()->default('AGABA Moussa');
            $table->string('client_name')->nullable();
            $table->decimal('amout_received', 10, 2)->nullable();
            $table->string('motif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decharges');
    }
};
