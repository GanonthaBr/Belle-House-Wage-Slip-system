<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'invoice_id',
        'designation_title',
        'designation_details',
        'designation_quantity',
        'designation_unit_price',
    ];



    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
