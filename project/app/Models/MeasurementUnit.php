<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    use HasFactory;

    protected $table = 'measurement_units';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable=['title', 'short_title'];
    
}
