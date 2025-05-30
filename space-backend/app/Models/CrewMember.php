<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
    use HasFactory;
    
    protected $table = 'crew_members';
    
    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'srcm',
        'srct',
        'srcd',
        'alt',
    ];
}
