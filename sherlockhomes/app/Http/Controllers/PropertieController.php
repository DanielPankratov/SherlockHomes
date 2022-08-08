<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\locations;
use App\Models\Propertie;
use App\Models\Properties;
use App\Models\PropertyWebsite;
use App\Models\TypePrice;
use App\Models\TypeProperty;
use App\Models\TypologyProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PropertieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {

            // $properties = Properties::orderBy('id', 'DESC')->get();
            $properties = Properties::all();
            $fotos = Foto::all();

            return view('admin.properties', compact('properties', 'fotos'));
        }else{
            return redirect(url()->previous());
        }  
    }

    public function favs(){
        if(Auth::user()!=null){
           
            $favorite_Properties_Ids = DB::table('properties_user')->where('user_id', Auth::user()->id)->get();
            $IdsFavs = [];
            // dd($favorite_Properties_Ids);
            foreach ($favorite_Properties_Ids as $f) {
                array_push($IdsFavs, $f->properties_id); 
            }

            $favProperties = Properties::whereIn('id', $IdsFavs)->get();            
            
            return view('favs', compact('favProperties'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //()
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {
            
        $propertyWebsite = PropertyWebsite::all();
        $typePrice = TypePrice::all();
        $typeProperty = TypeProperty::all();
        $typology = TypologyProperty::all();
        $locations = locations::all();

        return view('property.create', compact('propertyWebsite', 'typePrice', 'typeProperty', 'typology', 'locations'));
        }else{
            return redirect(url()->previous());
        }    

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        request()->validate([
            'tituloInput'=>'required',
            'inputPrice'=>'required',
            'selectPriceType'=>'required',
            'selectDistrict'=>'required',
            'selectPropertieType'=>'required',
            'selectTypology'=>'required',
            'inputBath'=>'required',
            'inputGrossArea'=>'required',
            'inputArea'=>'required',
            'selectWebsite'=>'required',
            'inputDesc'=>'required',
            'inputLink'=>'required'

        ]);

        $maxid = Properties::where('id', 'LIKE', 'SH%')->max('id');
        if ($maxid != null) {
            $maxid_ = str_replace("SH","", $maxid);
            $num_maxid = intval($maxid_);
            $new_id = "SH". $num_maxid+1;
        }
        else{
            $new_id = "SH0";
        }

        $property = new Propertie();
        $property->id = $new_id;
        $property->name=request('tituloInput');
        $property->price=request('inputPrice');
        $property->typeprice_id=request('selectPriceType');
        $property->location_id=request('selectDistrict');
        $property->typepropertie_id=request('selectPropertieType');
        $property->typology_id=request('selectTypology');
        $property->bathrooms=request('inputBath');
        $property->gross_area=request('inputGrossArea');
        $property->usefull_area=request('inputArea');
        $property->propertywebsite_id=request('selectWebsite');
        $property->descricao=request('inputDesc');
        $property->url=request('inputLink');

        $property->save();
        
        

        $request->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png|max:4096'
          ]);

          if($request->hasfile('imageFile')) {
              $i=0;
              foreach($request->file('imageFile') as $file)
              {
                  $i++;
                //   $name = $file->getClientOriginalName();
                  $name = $i.'.jpg';
                  $file->move(public_path().'/uploads/'.$new_id.'/', $name);  
                //   public_path('images/' . $filename);
                  $imgData[] = $name;  
                  
                  $fileModal = new Foto();
                  $fileModal->designacao = json_encode($imgData);
                  //!Mudar as barras "/" do image_path de baixo
                  $fileModal->image_path = public_path().'/uploads/'.$new_id.'/'.$name;
                  $fileModal->properties_id = $new_id;
                  $fileModal->save();
              }
            }

            return redirect('/properties')->with('message', 'Imóvel inserido com sucesso!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Propertie  $propertie
     * @return \Illuminate\Http\Response
     */
    // public function show(Properties $propertie)
    // {
    //     $propertyWebsite = PropertyWebsite::all();
    //     $typePrice = TypePrice::all();
    //     $typeProperty = TypeProperty::all();
    //     $typology = TypologyProperty::all();
    //     $locations = locations::all();

    //     $all_imgs = File::files(public_path('uploads/'.$propertie->id));
    //     $filecount = 0;
        
    //     $imagens = array();
    //     foreach ($all_imgs as $img) {
    //         // $name = basename($img);
    //         array_push($imagens, basename($img));
    //     }
    //     // dd($imagens);


    //     if ($all_imgs !== false) {
    //         $filecount = count($all_imgs);
    //     }
    //     // dd($all_imgs);

    //     return view('single-propertie', compact('propertie','propertyWebsite', 'typePrice', 'typeProperty', 'typology', 'locations', 'imagens'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Propertie  $propertie
     * @return \Illuminate\Http\Response
     */
    public function edit(Properties $propertie)
    {
        // dd($propertie);
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {
            
            $propertyWebsite = PropertyWebsite::all();
            $typePrice = TypePrice::all();
            $typeProperty = TypeProperty::all();
            $typology = TypologyProperty::all();
            $locations = locations::all();
            return view('property.edit', compact('propertie','propertyWebsite', 'typePrice', 'typeProperty', 'typology', 'locations'));
            
        }else{
            return redirect(url()->previous());
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Propertie  $propertie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Properties $propertie)
    {
        //
        request()->validate([
            'tituloInput'=>'required',
            'inputPrice'=>'required',
            'selectPriceType'=>'required',
            'selectDistrict'=>'required',
            'selectPropertieType'=>'required',
            'selectTypology'=>'required',
            'inputBath'=>'required',
            'inputGrossArea'=>'required',
            'inputArea'=>'required',
            'selectWebsite'=>'required',
            'inputDesc'=>'required',
            'inputLink'=>'required'

        ]);

        $propertie->name=request('tituloInput');
        $propertie->price=request('inputPrice');
        $propertie->typeprice_id=request('selectPriceType');
        $propertie->location_id=request('selectDistrict');
        $propertie->typepropertie_id=request('selectPropertieType');
        $propertie->typology_id=request('selectTypology');
        $propertie->bathrooms=request('inputBath');
        $propertie->gross_area=request('inputGrossArea');
        $propertie->usefull_area=request('inputArea');
        $propertie->propertywebsite_id=request('selectWebsite');
        $propertie->descricao=request('inputDesc');
        $propertie->url=request('inputLink');

        $propertie->save();
        
        

        $request->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png|max:4096'
          ]);

          if($request->hasfile('imageFile')) {
              $i=0;
              foreach($request->file('imageFile') as $file)
              {
                  $i++;
                //   $name = $file->getClientOriginalName();
                  $name = $i.'.jpg';
                  $file->move(public_path().'/uploads/'.$propertie->id.'/', $name);  
                //   public_path('images/' . $filename);
                  $imgData[] = $name;  
                  
                  $fileModal = new Foto();
                  $fileModal->designacao = json_encode($imgData);
                  //!Mudar as barras "/" do image_path de baixo
                  $fileModal->image_path = public_path().'/uploads/'.$propertie->id.'/'.$name;
                  $fileModal->properties_id = $propertie->id;
                  $fileModal->save();
              }
            }

            
            return redirect('/properties')->with('message', 'Imóvel atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Propertie  $propertie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Propertie $propertie)
    {
        //
        $propertie->delete();
        // $propertie->deleteDirectory(public_path().'/uploads/'.$propertie->id);
        File::deleteDirectory(public_path('/uploads/'.$propertie->id));

        return redirect(url()->previous())->with('message', 'Imóvel Apagado!');
    }
}
