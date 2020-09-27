<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_country',
        'name'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function scopeSearchByName($query, $text)
    {
        $query->where('name', 'LIKE', "%".$text."%");
    }
}
