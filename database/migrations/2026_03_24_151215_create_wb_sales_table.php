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
        Schema::create('wb_sales', function (Blueprint $table) {
            $table->id();
            $table->string('g_number')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('last_change_date')->nullable();
            $table->string('supplier_article')->nullable();
            $table->string('tech_size')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->decimal('total_price', 10, 2)->default(0);
            $table->integer('discount_percent')->default(0);
            $table->boolean('is_supply')->default(false);
            $table->boolean('is_realization')->default(false);
            $table->bigInteger('nm_id')->nullable();
            $table->string('subject')->nullable();
            $table->string('category')->nullable();
            $table->string('brand')->nullable();
            $table->string('sale_id')->nullable();
            $table->longText('raw_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_sales');
    }
};
