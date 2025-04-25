<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    
    protected $table = 'destinations';
    
    protected $fillable = [
        'title',
        'content',
        'km',
        'days',
        'srcm',
        'srct',
        'srcd',
        'alt',
    ];
}
