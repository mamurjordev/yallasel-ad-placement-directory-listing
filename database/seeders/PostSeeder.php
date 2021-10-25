<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostAttribute;
use App\Models\PostImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        File::deleteDirectory(public_path('media/posts'), true);

        Post::factory()->count(150)->create()->each(function ($post) {

            PostImage::factory()->count(random_int(2, 3))->create([
                'post_id' => $post->id
            ]);

            $colors = ['red', 'black', 'white'];
            $years = [2010, 1995, 1998, 2012, 2020, 1990];
            $car_types = ['small', 'cab', 'sedan', 'coupe', 'suv'];
            $fuels = ['diesel', 'petrol', 'electric', 'gasoline'];
            $gearboxes = ['automatic', 'manual', 'semi-auto'];
            $brands = ['BMW', 'Toyota', 'Ford', 'Honda', 'Audi'];

            $year = $years[array_rand($years, 1)];
            $car_type = $car_types[array_rand($car_types, 1)];
            $color = $colors[array_rand($colors, 1)];
            $fuel = $fuels[array_rand($fuels, 1)];
            $gearbox = $gearboxes[array_rand($gearboxes, 1)];
            $brand = $brands[array_rand($brands, 1)];

            PostAttribute::create([
                'post_id' => $post->id,
                'post_attribute' => '{
                    "brand":{"icon":"f013","value":"' . $brand . '","unit":""},
                    "model year":{"icon":"f013","value":' . $year . ',"unit":""},
                    "mileage":{"icon":"f013","value":' . rand(500, 50000) . ',"unit":"mile"},
                    "horsepower":{"icon":"f013","value":' . rand(40, 500) . ',"unit":"hp"},
                    "gearbox":{"icon":"f013","value":"' . $gearbox . '","unit":""},
                    "fuel":{"icon":"f013","value":"' . $fuel . '","unit":""},
                    "color":{"icon":"f013","value":"' . $color . '","unit":""},
                    "car type":{"icon":"f013","value":"' . $car_type . '","unit":""}
                }'
            ]);
        });
    }
}
