<?php

namespace App\Traits\Vehicle\Service;

use Carbon\Carbon;

trait HasCarbonDates
{
    /**
     * Get servicea at date carbon instance.
     *
     * @return Carbon\Carbon
     */
    public function servicedAt()
    {
        return (new Carbon($this->serviced_at))->startOfDay();
    }

    /**
     * Get scheduled at date carbon instance.
     *
     * @return Carbon\Carbon
     */
    public function scheduledAt()
    {
        return (new Carbon($this->scheduled_at))->startOfDay();
    }

    /**
     * Get canceled at date carbon instance.
     *
     * @return Carbon\Carbon
     */
    public function canceledAt()
    {
        return (new Carbon($this->canceled_at))->startOfDay();
    }

    /**
     * Get created at date carbon instance.
     *
     * @return Carbon\Carbon
     */
    public function createdAt()
    {
        return (new Carbon($this->created_at))->startOfDay();
    }

    /**
     * Get updated at date carbon instance.
     *
     * @return Carbon\Carbon
     */
    public function updatedAt()
    {
        return (new Carbon($this->updated_at))->startOfDay();
    }
}
