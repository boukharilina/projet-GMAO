<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementDemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipement_demos', function (Blueprint $table) {
            $table->id()->autoIncrement()->primaryKey();
            $table->string('code');
            $table->string('designation');
            $table->string('modele');
            $table->string('marque');
            $table->string('numserie');
            $table->foreignId('modalite_id')->constrained()->onDelete('cascade');
            $table->string('garantie')->nullable();
            $table->string('type_contrat')->nullable();
            $table->date('date_entree')->nullable();
            $table->integer('qte')->nullable();
            $table->string('fiche_technique')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('equipements_demos');
    }
}
