<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// helpers
use Illuminate\Support\Facades\Schema;

// models
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // non si può fare truncate se c'è foreign key, prima la diabilito
        Schema::disableForeignKeyConstraints();
        //poi truncate
        Type::truncate();
        // poi la rimetto
        Schema::enableForeignKeyConstraints();

        $allTypes = [
            'HTML',
            'CSS',
            'JS',
            'Vue',
            'SQL',
            'PHP',
            'Laravel',
        ];

        foreach($allTypes as $singleType){
            $type = Type::create([
                'title'=> $singleType,
                'slug' => str()->slug($singleType),
            ]);
        }
    }
}
