<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wage_slips', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->float('salaire_de_base');
            $table->float('heures_supplementaires');
            $table->float('prime_de_salissure');
            $table->float('prime_annuelle');
            $table->float('avance_sur_salaire');
            $table->float('assurance_maladie');
            $table->float('assurance_accident_de_travail');
            $table->string('nationalite');
            $table->string('nom_employee');
            $table->string('add_employee');
            $table->string('periode_de_paie');
            $table->date('date_de_paie');
            $table->date('date_de_debut');
            $table->date('date_de_fin');
            $table->string('emploi');
            $table->date('anciennete');
            $table->float('taxe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wage_slips');
    }
};
