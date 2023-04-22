<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'estimate_id',
        'invoice_id',
        'item_id',
        'qty',
        'price',
    ];
}
