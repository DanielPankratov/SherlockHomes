<?php

namespace App\Http\Controllers;

use App\Models\locations;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\TypePrice;
use App\Models\TypeProperty;
use App\Models\TypologyProperty;
use Illuminate\Support\Facades\File;
use App\Models\PropertyWebsite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Main extends Controller
{
    public function search(Request $request){
        
        
        $PriceType = (request('selectPriceType') == 'Todos') ? '': request('selectPriceType');
        $Location = (request('selectDistrict') == 'Todos') ? '': request('selectDistrict');
        $PropertyType = (request('selectPropertieType') == 'Todos') ? '': request('selectPropertieType');
        $Typology = (request('selectTypology') == 'Todos') ? '': request('selectTypology');
        $search_text =request('query');

        $results = Properties::query()->where('name', 'LIKE', '%'.$search_text.'%')  
            ->where('typeprice_id','LIKE','%'.$PriceType.'%')
            ->where('location_id','LIKE', '%'.$Location.'%')
            ->where('typepropertie_id','LIKE', '%'.$PropertyType.'%')
            ->where('typology_id','LIKE', '%'.$Typology.'%')
            ->orderBy('price', 'asc')
            // ->inRandomOrder()
            ->paginate(51)->setpath("http://127.0.0.1:8000/results?query=" . $search_text . "&selectPriceType=".$PriceType."&selectPropertieType=".$PropertyType."&selectTypology=".$Typology."&selectDistrict=".$Location."");
        if(count($results) != 0)
        {
            $prec_med_comp =  $results->where('typeprice_id', 'like', 1)->sum('price')/count($results);
            $prec_med_alug =  $results->where('typeprice_id', 'like', 2)->sum('price')/count($results);
        }else{
            $prec_med_comp =  0;
            $prec_med_alug =0;
        }
            // dd($prec_med_comp);
        // dd($prec_med);
        // $total_res = $results->total();
// dd($total_res);
            //  dd($results);
// $currentURL = URL::current();
// dd($currentURL);
        return view('results', compact('results', 'prec_med_comp', 'prec_med_alug'));
    }

    public function index(){

        $properties = Properties::latest()->take(3)->get();
        $typePrice = TypePrice::all();
        $typeProperty = TypeProperty::all();
        $typology = TypologyProperty::all();
        $locations = locations::all();

        $prec_med =  ($properties->sum('price'))/count($properties);
        // dd($prec_med);
        return view('index', compact('typePrice', 'typeProperty', 'typology', 'locations', 'properties'));

    }
    
    public function show(Properties $propertie)
    {
        $propertyWebsite = PropertyWebsite::all();
        $typePrice = TypePrice::all();
        $typeProperty = TypeProperty::all();
        $typology = TypologyProperty::all();
        $locations = locations::all();

        $all_imgs = File::files(public_path('uploads/'.$propertie->id));
        $filecount = 0;
        
        $imagens = array();
        foreach ($all_imgs as $img) {
            // $name = basename($img);
            array_push($imagens, basename($img));
        }
        // dd($imagens);


        if ($all_imgs !== false) {
            $filecount = count($all_imgs);
        }
        // dd($all_imgs);

        return view('single-propertie', compact('propertie', 'imagens'));
    }
}
