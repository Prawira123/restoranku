<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomNumber(5),
            'is_active' => $this->faker->boolean(),
            'category_id' => $this->faker->numberBetween(1, 2),
            'img' => $this->faker->randomElement([
                'https://images.unsplash.com/photo-1602273660127-a0000560a4c1',
                'https://images.unsplash.com/photo-1611518040286-9af8ba97ab46',
                'https://plus.unsplash.com/premium_photo-1674062989120-4ccc0eb35be0',
                'https://images.unsplash.com/photo-1614563637806-1d0e645e0940'
            ]),
        ];
    }
}
