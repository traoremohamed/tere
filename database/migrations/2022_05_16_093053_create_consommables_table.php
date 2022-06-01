<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsommablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consommables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rapport_id');
            $table->string('designation');
            $table->string('unite');
            $table->integer('quantite');
            $table->foreign('rapport_id')
                  ->references('id')
                  ->on('rapports')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
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
        Schema::dropIfExists('consommables');
    }
}
