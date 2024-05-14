<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = ['red', 'green', 'blue', 'yellow', 'black', 'white', 'orange', 'purple', 'pink'];

        $name = $this->faker->word;
        $slug = Str::slug($name); // Generar slug basado en el nombre del producto

        // Verifica si el slug ya existe en la base de datos
         $count = Product::where('slug', $slug)->count();

        // Si el slug ya existe, agrega un número al final para hacerlo único
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

         // Generar una imagen aleatoria y guardarla en la ruta especificada
        $imagePath = $this->faker->image(
            storage_path('app/public/images/products')
        );

        /* // Obtener el nombre de archivo de la imagen generada
        $imageName = basename($image); */

        return [
            'name' => $name,
            'slug' => $slug,
            'brand' => $this->faker->company,
            'color' => $this->faker->randomElement($colors),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'description' => $this->faker->sentence,
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => basename($imagePath),
            /* 'image' => $this->faker->imageUrl(), */
            'category_id' => Category::factory(),
        ];
    }
}
