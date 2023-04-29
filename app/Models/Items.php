<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'color',
        'type',
        'image',
    ];
    public function price(): HasOne
    {
        return $this->hasOne(Prices::class, 'item_id', 'id');
    }
    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class, 'item_id', 'id');
    }
  
   
}
