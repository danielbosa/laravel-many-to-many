<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/data/type_db.json'), true);

        foreach ($data as $type) {
            
            // Qui avrei potuto usare Type::create perché nel model ho specificato la proprietà fillable; MA devo generare lo slug tramite metodo --> quindi non posso, devo fare campo per campo
            //Type::create($type);

            
            $newType = new Type;
            $newType->name = $type['name'];
            $newType->icon = $type['icon'];
            $newType->slug = Type::generateSlug($newType->name);
            $newType->save();

        }
    }
}
