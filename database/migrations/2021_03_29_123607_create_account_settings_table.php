<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('surveillance')->default(true);
            $table->boolean('messagenotify')->default(true);
            $table->boolean('adtips')->default(true);
            $table->boolean('allow_facebook_market')->default(true);
            $table->boolean('allow_google_market')->default(true);
            $table->foreignId('city_id')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->string('shop_banner')->nullable();
            $table->longText('shop_desc')->nullable();
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
        Schema::dropIfExists('account_settings');
    }
}
