<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                ['name' => 'free_post', 'value' => 0],
                ['name' => 'android_app', 'value' => '#!'],
                ['name' => 'ios_app', 'value' => '#!'],
                ['name' => 'site_title', 'value' => 'yallasell'],
                ['name' => 'site_logo', 'value' => null],
                ['name' => 'site_mobile_logo', 'value' => null],
                ['name' => 'ad_boost_price', 'value' => 12],
            ]
        );
    }
}
