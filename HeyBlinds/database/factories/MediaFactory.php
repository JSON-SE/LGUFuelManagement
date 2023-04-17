<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'alt_text' => $this->faker->name,
            'caption' => $this->faker->name,
            'description' => $this->faker->text(200),
            'original_path' => 'https://picsum.photos/seed/picsum/200/300',
            'thumb_path' => 'https://picsum.photos/seed/picsum/200/300',
            'original_url' => 'https://picsum.photos/seed/picsum/200/300',
            'thumb_url' => 'https://picsum.photos/seed/picsum/200/300',
        ];
    }
}
