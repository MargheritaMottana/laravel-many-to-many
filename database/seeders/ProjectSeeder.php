<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// helpers
use Illuminate\Support\Facades\Schema;

// model
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Project::truncate();
        });
        
        for($i=0; $i<10; $i++) {

            // creo una variabile per titolo e per slug
            $title = fake()->words(5, true);
            // aggiunta slug
            $slug = str()->slug($title);

            // mi prendo un'istanza casuale dalla tabella dei type
            $randomType= Type::inRandomOrder()->first();

            $project = Project::create([

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

            // creo un array vuoto
            $technologyIds = [];

            // prendo un numero random contanto tra 0 e gli elementi di technology
            for ($j=0; $j < rand(0, Technology::count()) ; $j++) { 

                // prendo una tecnologia random
                $randomTechnology = Technology::inRandomOrder()->first();

                // se non esiste ancora nell'array la pusho
                if (!in_array($randomTechnology->id, $technologyIds)) {
                    $technologyIds[] = $randomTechnology->id;
                }
            }

            // alla fine del ciclo, sincronizzo le tecnologie
            $project->technologies()->sync($technologyIds);
        }
    }
}
