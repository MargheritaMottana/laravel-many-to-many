<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// helpers
use Illuminate\Support\Facades\Schema;

// models
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Technology::truncate();
        });
        
        for($i = 0; $i < 10; $i++){
            Technology::create([
                'title'=> fake()->word(),
            ]);
        }
    }
}
