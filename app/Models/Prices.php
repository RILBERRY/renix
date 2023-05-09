<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prices extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'item_id',
        'cost_price',
        'fright',
        'clearance',
        'max_discount',
        'price_before_tax',
        'is_taxable',
        'unit_price',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchases::class);
    }
}
