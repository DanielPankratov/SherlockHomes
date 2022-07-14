<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
   protected $fillable = [
       'designacao'
   ];
    
    use HasFactory;

    public function properties(){
        return $this->belongsTo(Properties::class, 'properties_id');
    }
}
