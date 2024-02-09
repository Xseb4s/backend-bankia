<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credits extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'dues',
        'fee_value',
        'type_credit',
        'approver_id',
        'fk_user',
    ];
    
}
