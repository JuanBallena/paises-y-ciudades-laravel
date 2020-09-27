<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function scopeSearchByName($query, $text)
    {
        $query->where('name', 'LIKE', "%".$text."%");
    }
}
