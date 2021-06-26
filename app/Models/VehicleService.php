<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Vehicle\HasCarbonDates;
use App\Traits\Vehicle\Service\HasServiceStasuses;
use App\Traits\Vehicle\Service\HasServiceTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Get the vehicle that owns the VehicleService
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the user that owns the VehicleService
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
