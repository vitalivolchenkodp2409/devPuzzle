<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divide extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    
    public function technology()
    {
        return $this->hasMany(Technology::class);    
    } 
}
