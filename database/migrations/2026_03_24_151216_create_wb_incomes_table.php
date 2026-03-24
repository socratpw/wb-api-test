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
        Schema::create('wb_incomes', function (Blueprint $table) {
            $table->id();
            $table->integer('income_id')->nullable();
            $table->string('number')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('last_change_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->timestamp('date_close')->nullable();
            $table->string('warehouse_name')->nullable();
            $table->bigInteger('nm_id')->nullable();
            $table->string('status')->nullable();
            $table->longText('raw_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_incomes');
    }
};
