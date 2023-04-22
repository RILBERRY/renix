<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    use HasFactory;
    protected $fillable = [
        'assign_to',
        'name',
        'currency_type',
        'status',
        'balance',
    ];
}
