<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->decimal('product_price');
            $table->string('product_discount_price')->nullable();
            $table->integer('product_months_of_warranty');
            $table->date('product_manufacturing_date');
            $table->string('unit_of_measure');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('manufacturer_id')->constrained('manufacturers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
