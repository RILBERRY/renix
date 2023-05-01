<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Estimate extends Model
{
    use HasFactory;
    protected $fillable = [
        'estimate_no',
        'valid_till',
        'customer_id',
        'status',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }

}
