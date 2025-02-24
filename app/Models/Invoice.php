<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'client_id',
        'client_name',
        'client_phone',
        'client_mail',
        'client_city',
        'client_country',
        'client_quartier',
        'facture_type',
        'number',
        'echeance',
        'tax',
        'type_tax',
        'objet',
        'payment_mode',
        'montant_avanc',
        'designation_title',
        'designation_detail',
        'designation_quantity',
        'designation_unit_price'
    ];

    public function items()
    {
        return $this->hasMany(Designation::class);
    }
}
