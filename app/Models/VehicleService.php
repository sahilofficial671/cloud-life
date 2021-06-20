<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Vehicle\HasCarbonDates;
use App\Traits\Vehicle\HasServiceStasuses;

class VehicleService extends Model
{
    use HasFactory, SoftDeletes, HasCarbonDates, HasServiceStasuses;

    protected $fillable = [
        'name',
        'description',
        'vehicle_id',
        'type_id',
        'scheduled_at',
        'serviced_at'
    ];
}
