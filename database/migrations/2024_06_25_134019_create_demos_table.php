<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demos', function (Blueprint $table) {
            $table->id()->autoIncrement()->primaryKey();
            $table->foreignId('equipement_demo_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('service');
            $table->string('contact_client')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_sortie');
            $table->date('date_retour');
            $table->string('statut');
            $table->string('bon_sortie')->nullable();
            $table->date('bon_retour')->nullable();
            $table->date('date_prolongation')->nullable();
            $table->string('commentaire')->nullable();
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
        Schema::dropIfExists('demos');
    }
}
