<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Project;


class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','icon'];

    //Ho bisogno che lo slug sia unico per ogni type, quindi ciclo, conto e in base al count definisco slug
    public static function generateSlug($name)
    {
        $slug = Str::slug($name, '-');
        $count = 1;
        while(Project::where('slug', $slug)->first()){
            $slug = Str::slug($name, '-') . "-{$count}";
            $count++;
        }
        return $slug;
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
