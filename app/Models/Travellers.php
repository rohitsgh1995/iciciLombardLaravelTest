<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travellers extends Model
{
    use HasFactory;

    protected $fillable = [
        'traveller_name'
    ];
}
