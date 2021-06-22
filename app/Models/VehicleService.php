<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Vehicle\HasCarbonDates;
use App\Traits\Vehicle\Service\HasServiceStasuses;
use App\Traits\Vehicle\Service\HasServiceTypes;
use Illuminate\Database\Eloquent\Builder;

class VehicleService extends Model
{
    use HasFactory, SoftDeletes, HasCarbonDates, HasServiceStasuses, HasServiceTypes;

    const TYPE_MONTHLY = 1;
    const TYPE_CUSTOM = 2;

    protected $fillable = [
        'name',
        'description',
        'vehicle_id',
        'type_id',
        'scheduled_at',
        'serviced_at',
        'completed_at',
        'canceled_at'
    ];
}
