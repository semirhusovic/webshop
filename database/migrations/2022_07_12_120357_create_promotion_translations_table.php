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
        Schema::create('promotion_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('promotion_id')->constrained('promotions')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('promotion_name');
            $table->unique(['promotion_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_translations');
    }
};
