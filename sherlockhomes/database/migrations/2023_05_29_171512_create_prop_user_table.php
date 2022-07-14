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
        Schema::create('properties_user', function (Blueprint $table) {
            $table->id();
            $table->string('properties_id');
            $table->bigInteger('user_id');
            $table->timestamps();

            $table->foreign('properties_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prop_user');
    }
};
