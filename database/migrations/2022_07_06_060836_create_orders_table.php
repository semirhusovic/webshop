<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_amount');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('billing_address');
            $table->string('city');
            $table->string('email');
            $table->string('cc_number')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('status_id')->constrained('order_statuses');
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
        Schema::dropIfExists('orders');
    }
};
