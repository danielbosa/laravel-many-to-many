<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $types = Type::pluck('id');
        $technologies = Technology::pluck('id');
        for($i = 0; $i < 10; $i++){
            $shuffledTechnologies = $technologies->shuffle();
            $shuffledTypes = $types->shuffle();
            $newProject = new Project();
            $newProject->title = $faker->sentence;
            $newProject->url = $faker->url;
            $newProject->slug = Project::generateSlug($newProject->title);
            $newProject->type_id = $shuffledTypes->first();
            $newProject->save(); 
            $newProject->technologies()->attach($shuffledTechnologies->take(2));
        }
        
    }
}
