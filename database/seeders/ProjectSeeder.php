<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// model
use App\Models\Project;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        for($i=0; $i<10; $i++) {

            // creo una variabile per titolo e per slug
            $title = fake()->words(5, true);
            // aggiunta slug
            $slug = str()->slug($title);

            // mi prendo un'istanza casuale dalla tabella dei type
            $randomType= Type::inRandomOrder()->first();

            Project::create([

                'title' => $title,
                'slug' => $slug,
                'description' => fake()->paragraph(),
                'cover' => fake()->optional()->imageUrl(),
                'client' => fake()->words(2, true),
                'sector' => fake()->word(),
                'published' => fake()->boolean(70),

                // aggiungo la colonna type_id
                'type_id' => $randomType->id,

            ]);
        }
    }
}
