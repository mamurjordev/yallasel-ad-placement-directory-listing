<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('title');
            $table->longText('detail');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->boolean('hidePhoneInAd')->nullable();

            $table->string('zipcode');
            $table->foreignId('city_id');
            $table->foreignId('region_id');
            $table->string('payment');

            $table->string('reason');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_seller')->default(1);
            $table->integer('is_individual');
            $table->boolean('is_paid')->default(0);
            $table->string('expected_price', 50);
            $table->boolean('is_price_negotiable')->default(0);
            $table->timestamp('boost_until')->nullable();
            $table->boolean('allow_posts_used')->default(false);
            $table->string('status');

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
        Schema::dropIfExists('posts');
    }
}
