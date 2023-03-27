<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityTravelHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'traveller_id', 'city_id', 'from_date', 'to_date'
    ];

    public function traveller()
    {
        return $this->belongsTo(Travellers::class, 'traveller_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id', 'id');
    }
}
