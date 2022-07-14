<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Properties extends Model
{
    use HasFactory;

    // public $increment = false;
    protected $casts = [ 'id' => 'string' ];    

    public function typeprice(){
        return $this->belongsTo(TypePrice::class, 'typeprice_id');
    }
    
    public function typeproperty(){
        return $this->belongsTo(TypeProperty::class, 'typepropertie_id');
    }
    // return $this->belongsTo(TypologyProperty::class, 'typology_id');
    
    public function typologyproperty(){
        return $this->belongsTo(TypologyProperty::class, 'typology_id');
    }
    
    public function propertywebsite(){
        return $this->belongsTo(PropertyWebsite::class, 'propertywebsite_id');
    }
    
    public function locations(){
        return $this->belongsTo(locations::class, 'location_id');
    }

    public function foto(){
        return $this->hasmany(Foto::class);
    }

    public function favorite_to_user(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
