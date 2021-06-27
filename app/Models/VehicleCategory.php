<?php

namespace App\Models;

use App\Traits\Vehicle\HasVehicleCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory, HasVehicleCategories;

    protected $fillable = [
        'name',
        'description',
    ];
}
