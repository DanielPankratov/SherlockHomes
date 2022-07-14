<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name', 500);
            $table->integer('price');
            $table->unsignedBigInteger('typeprice_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('typepropertie_id');
            $table->unsignedBigInteger('typology_id');
            $table->integer('bathrooms');
            $table->integer('gross_area');
            $table->integer('usefull_area');
            $table->unsignedBigInteger('propertywebsite_id');
            $table->string('descricao', 5000);
            $table->string('url', 5000);
            $table->timestamps();
 
            $table->foreign('typeprice_id')
                ->references('id')
                ->on('type_prices')
                ->onDelete('cascade');

            $table->foreign('typepropertie_id')
                ->references('id')
                ->on('type_properties')
                ->onDelete('cascade');

            $table->foreign('typology_id')
                ->references('id')
                ->on('typology_properties')
                ->onDelete('cascade');

            $table->foreign('propertywebsite_id')
                ->references('id')
                ->on('property_websites')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');


        });

        // Schema::table('properties', function(Blueprint $table)
        // {
        // $table->foreign('typeprice_id')
        //         ->references('id')
        //         ->on('type_prices')
        //         ->onDelete('cascade');

        // $table->foreign('typepropertie_id')
        //     ->references('id')
        //     ->on('type_properties')
        //     ->onDelete('cascade');

        // $table->foreign('typology_id')
        //     ->references('id')
        //     ->on('typologyproperties')
        //     ->onDelete('cascade');

        // $table->foreign('propertywebsite_id')
        //     ->references('id')
        //     ->on('property_websites')
        //     ->onDelete('cascade');


        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
