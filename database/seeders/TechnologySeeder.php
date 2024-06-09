<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/technology_db.json'), true);

        foreach ($data as $technology) {
            
            // Qui avrei potuto usare Technology::create perché nel model ho specificato la proprietà fillable; MA devo generare lo slug tramite metodo --> quindi non posso, devo fare campo per campo
            //Technology::create($technology);
            
            $newTechnology = new Technology();
            $newTechnology->name = $technology['name'];
            $newTechnology->icon = $technology['icon'];
            $newTechnology->slug = Technology::generateSlug($newTechnology->name);
            $newTechnology->save();

        }
    }
}
