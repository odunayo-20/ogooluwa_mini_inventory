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
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->foreignId('customer_id')->constrained()->onDelete('cascade');
                // $table->integer('customer_id');
                $table->string('total_amount');
                $table->date('sale_date')->nullable();
                $table->string('payment_method')->nullable();
                $table->boolean('status')->default(0)->nullable();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
