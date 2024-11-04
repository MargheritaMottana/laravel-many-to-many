<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover',
        'client',
        'sector',
        'published',
        'type_id',
    ];

    // relationship 

    // un progetto vede un type

    public function type(){
        return $this->belongsTo(Type::class);
    }
}
