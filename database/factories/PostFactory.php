<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
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
        return [
            //
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->sentence(),
            'body' => "<p>".$this->faker->paragraph(50)."</p><p>".$this->faker->paragraph(100)."</p><p>".$this->faker->paragraph()."</p>",
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'image'=>"images/posts/60c2de5080ce0.PNG"
        ];
    }
}
