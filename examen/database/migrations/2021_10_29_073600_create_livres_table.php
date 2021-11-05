<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();                          
            $table->string('book_name')->unique();//le nom du livre doit etre unique , pour eviter de le mettre le meme livre plusieur foie 
            $table->string('author_name');
            $table->text('opinion')->nullable();
            $table->integer('note');
            $table->timestamps();//created_at and updated at 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livres');
    }
}
