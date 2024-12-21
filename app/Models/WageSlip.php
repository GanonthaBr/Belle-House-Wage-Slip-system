<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WageSlip extends Model
{
    protected $table = 'wage_slips';
    protected $fillable = [
        'matricule',
        'salaire_de_base',
        'heures_supplementaires',
        'prime_de_salissure',
        'prime_annuelle',
        'avance_sur_salaire',
        'assurance_maladie',
        'assurance_accident_de_travail',
        'nationalite',
        'nom_employee',
        'add_employee',
        'periode_de_paie',
        'date_de_paie',
        'date_de_debut',
        'date_de_fin',
        'emploi',
        'anciennete',
        'taxe',
        'employee_phone',
    ];
}
