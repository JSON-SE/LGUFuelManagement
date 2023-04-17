<?php

namespace Database\Factories;

use App\Models\Admin\ColorGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ColorGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'is_enabled' => true
        ];
    }
}
