<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payables extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'currency',
        'status',
        'ref_number',
        'approved_by',
        'fund_id',
    ];
}
