<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Post;
use App\Models\User;
use App\Models\Region;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();
        return [
            'user_id' => $user->id,
            // 'category_id' => Category::all()->random()->id,
            'category_id' => 1,
            'title' => $this->faker->sentences(1, true),
            'detail' => $this->faker->sentences(4, true),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->mobile ?? '',
            'hidePhoneInAd' => $this->faker->randomElement([true, false]),
            'zipcode' => $this->faker->postcode,
            'city_id' => City::all()->random()->id,
            'region_id' => Region::all()->random()->id,
            'payment' => $this->faker->creditCardType,
            'reason' => 'for-sale',
            'is_active' => true,
            'is_individual' => true,
            'is_paid' => true,
            'expected_price' => $this->faker->numberBetween(5000, 100000),
            'is_price_negotiable' => true,
            'status' => 'publish'
        ];
    }
}
