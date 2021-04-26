<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image',
        'public',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_recipes');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')->withPivot('quantity', 'measurement_unit_id')
            ->join('measurement_units', 'recipe_ingredients.measurement_unit_id', '=', 'measurement_units.id')
            ->select('ingredients.*', 'measurement_units.short_title AS units_title');
    }
}
