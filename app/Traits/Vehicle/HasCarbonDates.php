<?php

namespace App\Traits\Vehicle;

use Carbon\Carbon;

trait HasCarbonDates{

    /**
     * Get servicea at date carbon instance
     *
     * @return Carbon\Carbon
    */
    public function servicedAt()
    {
        return new Carbon($this->serviced_at);
    }

    /**
     * Get scheduled at date carbon instance
     *
     * @return Carbon\Carbon
    */
    public function scheduledAt()
    {
        return new Carbon($this->scheduled_at);
    }
}
