<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class Funds extends Model
{
    use HasFactory;
    protected $fillable = [
        'assign_to',
        'name',
        'currency',
        'status',
        'balance',
    ];
    protected $attributes = [
        'status' => 1,
    ];
    public static function checkAndCollect(Request $request, $id = null)
    {
        $rules = [
            'assign_to' => 'required',
            'currency' => 'required',
            'status' => 'nullable',
            'balance' => 'required',
        ];

        if ($id) {
            $rules['name'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('funds')->ignore($id),
            ];
        } else {
            $rules['name'] = 'required|unique:funds';
        }

        return $request->validate($rules);
    }

    public function assignTo()
    {
        return $this->belongsTo(User::class,'assign_to');
    }

}
