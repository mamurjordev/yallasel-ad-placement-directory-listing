<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('category_name');
            $table->string('category_name_ar');
            $table->foreignId('parent_category')->nullable()->references('id')->on('categories');
            $table->text('image');
            $table->string('status')->default('pending');
            $table->integer('items_count')->nullable();
            $table->text('note')->nullable();
            $table->integer('post_max_images_allow');
            $table->integer('post_validity_interval');
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
        Schema::dropIfExists('categories');
    }
}
