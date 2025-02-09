<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{

        public function up()
        {
            Schema::create('categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('nombre');
                $table->integer('nivel');
                $table->timestamps();
            });
        }
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('categories');
        }
    };


