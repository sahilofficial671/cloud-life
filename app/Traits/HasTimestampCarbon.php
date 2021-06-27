<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasTimestampCarbon
{
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
