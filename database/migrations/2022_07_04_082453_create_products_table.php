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
//            $table->string('productName');
            $table->string('productPrice');
            $table->string('productDiscountPrice')->nullable();
//            $table->text('productDescription');
            $table->integer('productMonthsOfWarranty');
            $table->date('productManufacturingDate');
            $table->foreignId('country_id')->constrained('countries');
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
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
