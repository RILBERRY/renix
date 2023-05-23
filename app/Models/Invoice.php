<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_no',
        'customer_id',
        'tax',
        'status',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'invoice_id', 'id');
    }
    public static function getEstimateTotal($id)
	{
        return Orders::where('invoice_id',$id)->selectRaw('SUM(qty * (price/100)) as total')->first()->total;
	}
}
