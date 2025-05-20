<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'name',
        'client_name',
        'amout_received',
        'motif',
        'phone',
        'object',
        'gender',
        'stamp,'
    ];
}
