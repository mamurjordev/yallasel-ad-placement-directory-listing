<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Category::factory(5)->create();
        // \App\Models\Language::factory(2)->create();

        $this->call([
            SettingSeeder::class
        ]);

        \App\Models\Page::create([
            'title' => 'Terms of use',
            'slug' => 'terms-of-use',
            'content' => 'content'
        ]);

        \App\Models\Category::create([
            'user_id' => 1,
            'category_name' => 'car',
            'category_name_ar' => 'السيارات',
            'image' => '',
            'status' => 'publish',
            'items_count' => 0,
            'post_max_images_allow' => 10,
            'post_validity_interval' => 10
        ]);
        \App\Models\Category::create([
            'user_id' => 1,
            'category_name' => 'bed',
            'category_name_ar' => 'سرير',
            'image' => '',
            'status' => 'publish',
            'items_count' => 0,
            'post_max_images_allow' => 10,
            'post_validity_interval' => 10
        ]);
        \App\Models\Category::create([
            'user_id' => 1,
            'category_name' => 'television',
            'category_name_ar' => 'التلفاز',
            'image' => '',
            'status' => 'publish',
            'items_count' => 0,
            'post_max_images_allow' => 10,
            'post_validity_interval' => 10
        ]);
        \App\Models\Category::create([
            'user_id' => 1,
            'category_name' => 'mobile',
            'category_name_ar' => 'التليفون المحمول',
            'image' => '',
            'status' => 'publish',
            'items_count' => 0,
            'post_max_images_allow' => 10,
            'post_validity_interval' => 10
        ]);

        \App\Models\Language::create([
            'language_name' => 'Arabic',
        ]);
        \App\Models\Language::create([
            'language_name' => 'English',
        ]);

        \App\Models\Country::create([
            'country_name' => 'iraq',
            'country_name_ar' => 'ٱلْعِرَاق‎',
            'currency_code' => 'iqd',
            'currency_code_ar' => 'دينار'
        ]);

        // \App\Models\State::factory(2)->create();
        $regions = array('Baghdad', 'Basra', 'Najaf', 'Duhok', 'Ninawa', 'Erbil', 'Kirkuk', 'Sulaymaniyah', 'Diyala', 'Babil', 'Wasit', 'Karbala', 'Al Diwania', 'Dikar', 'Misan', 'Slahaddin', 'AL Anbar', 'Al muthanna');
        foreach ($regions as $region) {
            \App\Models\Region::create([
                'region_name' => $region,
                'region_name_ar' => $region,
                'city_id' => '1'
            ]);
        }

        //$cities = array("Ad-Dawr", "Akre", "Al Kharjah", "Al Zab", "Al-Aziziyah", "Al-Hay", "Al-Meshkhab", "Al-Shamiya", "Al-Suwaira", "Amarah", "Ayn al-Tamr", "Baghdad", "Baiji", "Balad", "Baqubah", "Baradān", "Basra", "Bismayah", "Al Diwaniyah", "Duhok", "Fallujah", "Haditha", "Hamza", "Hawija", "Hillah", "Hit", "Iskan", "Iskandariya", "Jarjaraya", "Karbala", "Khanaqin", "Kirkuk", "Kut", "Miqdadiyah", "Mosul", "Najaf", "Nasiriyah", "Qalatga Darband", "Ramadi", "Samarra", "Samawah", "Tal Afar", "Tikrit", "Turbah Karbala", "Umm Qasr", "Yathrib");
        $cities = array(
            'Baghdad' => 'بَغْدَاد‎',
            'Basra' => 'ٱلْبَصْرَة‎',
            'Najaf' => 'ٱلنَّجَف‎',
            'Duhok' => 'دهوك‎',
            'Ninawa' => 'نَيْنَوَىٰ‎',
            'Erbil' => 'ھەولێر',
            'Kirkuk' => 'كركوك‎',
            'Sulaymaniyah' => 'السليمانية‎',
            'Diyala' => 'ديالى',
            'Babil' => 'بابل‎ ',
            'Wasit' => 'وَاسِط‎',
            'Karbala' => 'كَرْبَلَاء‎',
            'Al Diwaniyah' => 'ٱلدِّيوَانِيَّة‎ ',
            'Dikar' => 'ذي قار',
            'Misan' => 'ميسان',
            'Slahaddin' => 'صلاح الدين',
            'AL Anbar' => 'الانبار',
            'Al muthanna' => 'المثنى'
        );

        foreach ($cities as $key => $value) {
            \App\Models\City::create([
                'city_name' => $key,
                'city_name_ar' => $value,
                'country_id' => '1'
            ]);
        }
        \App\Models\County::factory(2)->create();
        //  \App\Models\Post::factory(5)->create();
        \App\Models\User::create([
            'username' => 'user1',
            'email' => 'a@a.com',
            'password' => Hash::make('123'),
            'name' => 'User1',
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);
        \App\Models\User::create([
            'username' => 'user2',
            'email' => 'ab@a.com',
            'password' => Hash::make('123'),
            'name' => 'User2',
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);
        // \App\Models\User::create([
        //     'username' => 'user3',
        //     'email' => 'abc@a.com',
        //     'password' => Hash::make('123'),
        //     'name' => 'User3',
        //     'email_verified_at' => now(),
        //     'role' => 'admin'
        // ]);
        \App\Models\Payment::create([
            'user_id' => 1,
        ]);
        \App\Models\AccountSetting::create([
            'user_id' => 1,
        ]);

        // \App\Models\ChatRoom::create([
        //     'user1' => 1,
        //     'user2' => 2
        // ]);
        // \App\Models\ChatRoom::create([
        //     'user1' => 1,
        //     'user2' => 3
        // ]);

        $this->call([
            PostSeeder::class
        ]);
    }
}
