<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];

    // relationship 

    // un type vede tanti progetti

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
