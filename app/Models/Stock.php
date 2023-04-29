<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'qty_in',
        'qty_out',
    ];
    public function item(): BelongsTo
    {
        return $this->belongsTo(Items::class);
    }

}
