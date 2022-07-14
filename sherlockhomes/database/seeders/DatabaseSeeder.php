<?php

namespace Database\Seeders;

use App\Models\locations;
use App\Models\PropertyWebsite;
use App\Models\TypePrice;
use App\Models\TypeProperty;
use App\Models\TypologyProperty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TypeProperty::create([
            'id' => '1',
            'typeproperty' => 'Apartamento'
        ]);
        TypeProperty::create([
            'id' => '2',
            'typeproperty' => 'Moradia'
        ]);
        TypeProperty::create([
            'id' => '3',
            'typeproperty' => 'Quintas e Herdades'
        ]);


        Locations::create([
            'id' => '1',
            'location' => 'Aveiro'
        ]);
        Locations::create([
            'id' => '2',
            'location' => 'Beja'
        ]);
        Locations::create([
            'id' => '3',
            'location' => 'Braga'
        ]);
        Locations::create([
            'id' => '4',
            'location' => 'Bragança'
        ]);
        Locations::create([
            'id' => '5',
            'location' => 'Castelo Branco'
        ]);
        Locations::create([
            'id' => '6',
            'location' => 'Coimbra'
        ]);
        Locations::create([
            'id' => '7',
            'location' => 'Évora'
        ]);
        Locations::create([
            'id' => '8',
            'location' => 'Faro'
        ]);
        Locations::create([
            'id' => '9',
            'location' => 'Guarda'
        ]);
        Locations::create([
            'id' => '10',
            'location' => 'Leiria'
        ]);
        Locations::create([
            'id' => '11',
            'location' => 'Lisboa'
        ]);
        Locations::create([
            'id' => '12',
            'location' => 'Portalegre'
        ]);
        Locations::create([
            'id' => '13',
            'location' => 'Porto'
        ]);
        Locations::create([
            'id' => '14',
            'location' => 'Santarém'
        ]);
        Locations::create([
            'id' => '15',
            'location' => 'Setúbal'
        ]);
        Locations::create([
            'id' => '16',
            'location' => 'Viana do Castelo'
        ]);
        Locations::create([
            'id' => '17',
            'location' => 'Vila Real'
        ]);
        Locations::create([
            'id' => '18',
            'location' => 'Viseu'
        ]);


        TypePrice::create([
            'id' => '1',
            'typeprice' => 'Comprar'
        ]);
        TypePrice::create([
            'id' => '2',
            'typeprice' => 'Alugar'
        ]);

        TypologyProperty::create([
            'id' => '1',
            'typology' => 'T0'
        ]);
        TypologyProperty::create([
            'id' => '2',
            'typology' => 'T1'
        ]);
        TypologyProperty::create([
            'id' => '3',
            'typology' => 'T2'
        ]);
        TypologyProperty::create([
            'id' => '4',
            'typology' => 'T3'
        ]);
        TypologyProperty::create([
            'id' => '5',
            'typology' => 'T4'
        ]);
        TypologyProperty::create([
            'id' => '6',
            'typology' => 'T5'
        ]);
        TypologyProperty::create([
            'id' => '7',
            'typology' => 'Outros'
        ]);

        PropertyWebsite::create([
            'id' =>'1',
            'website' =>'Casa Sapo'
        ]);
        PropertyWebsite::create([
            'id' =>'2',
            'website' =>'Imovirtual'
        ]);
        PropertyWebsite::create([
            'id' =>'3',
            'website' =>'BPI Expresso'
        ]);
        // $admin  = Role::create(['name' => 'admin']);
        // $superadmin = Role::create(['name'=> 'superadmin']);

        // $user = User::create([
        //     'email' => 'superadmin@gmail.com',
        //     'name' => 'Super Admin',
        //     'password' => Hash::make('Daniel+333')
        // ]);

        // $user->attachRole('superadmin');
        // $user->attachRole('admin');
        


        $this->call(LaratrustSeeder::class);
    }
}
