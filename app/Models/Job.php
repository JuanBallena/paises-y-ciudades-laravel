<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'id_country',
        'id_state',
        'id_city',
        'status'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'id_country', 'id_country');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state', 'id_state');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city', 'id_city');
    }

    public function scopeSearchByTitleOrDescription($query, $text)
    {
        $query->where('title', 'LIKE', '%'.$text.'%')
            ->orWhere('description', 'LIKE', '%'.$text.'%');
    }

    public function scopeSearchByCountryOrStateOrCity($query, $country, $state, $city)
    {
        $query->where('id_country', $country->id_country ?? -1)
            ->orWhere('id_state', $state->id_state ?? -1)
            ->orWhere('id_city', $city->id_city ?? -1);
    }
}
