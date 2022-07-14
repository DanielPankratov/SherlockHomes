<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($prop){

        $user = Auth::user();
        $isFavorite = $user->favorite_props()->where('properties_id', $prop)->count();

        if($isFavorite == 0){
            $user->favorite_props()->attach($prop);
            return redirect(url()->previous());
        }else{
            $user->favorite_props()->detach($prop);
            return redirect(url()->previous());
        }

    }
}
