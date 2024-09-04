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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('street_number');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('postal_code');
            $table->text('delivery_instructions')->nullable();
            $table->timestamps();
        });
    }
};
