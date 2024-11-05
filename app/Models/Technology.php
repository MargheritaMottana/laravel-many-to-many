<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    // relazioni
    
    // tante tecnologie vedono tanti progetti

    public function projects(){
        return $this->belongsToMany(Project::class)
                    ->withTimestamps();
    }
}
