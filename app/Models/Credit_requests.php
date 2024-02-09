<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit_requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'dues',
        'description',
        'status',
        'observation',
        'fk_type_credit',
        'fk_user',
    ];
}
