<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePrice extends Model
{
    use HasFactory;

    public function properties(){
        return $this->hasMany(Properties::class);
    }
}
