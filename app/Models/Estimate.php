<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $fillable = [
        'estimate_no',
        'valid_till',
        'customer_id',
    ];
}
