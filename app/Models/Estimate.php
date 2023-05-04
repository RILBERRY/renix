<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orders;
use App\Models\Customers;

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
    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'estimate_id', 'id');
    }
    public static function getEstimateTotal($id)
	{
        return Orders::where('estimate_id',$id)->selectRaw('SUM(qty * price) as total')->first()->total;
	}

}
