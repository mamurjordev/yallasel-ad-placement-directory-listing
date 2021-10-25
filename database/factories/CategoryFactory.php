<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'category_name' => $this->faker->word,
            'image' => $this->faker->imageUrl() ,
            'status' => 'publish' ,
            'items_count' => $this->faker->randomNumber() ,
            'note' => $this->faker->sentence,
            'post_max_images_allow' => 10 ,
            'post_validity_interval' => 10
        ];
    }
}
