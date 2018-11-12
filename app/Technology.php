<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function divide()
    {
        return $this->belongsTo(Divide::class, 'divide_id');
    }
}
