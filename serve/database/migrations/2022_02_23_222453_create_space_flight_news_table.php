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
        Schema::create('space_flight_news', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->boolean('featured')->default(0);
            $table->text('title')->nullable();
            $table->text('url')->nullable();
            $table->text('imageUrl')->nullable();
            $table->text('newsSite')->nullable();
            $table->text('summary')->nullable();
            $table->string('publishedAt')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('space_flight_news');
    }
};
