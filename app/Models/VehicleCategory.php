<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\Vehicle\HasVehicleCategories;

class VehicleCategory extends Model
{
    use HasFactory, HasVehicleCategories;

    protected $fillable = [
        'name',
        'description',
    ];
}
