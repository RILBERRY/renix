<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'estimate_id',
        'invoice_id',
        'title',
        'description',
        'qty',
        'price',
    ];


}
