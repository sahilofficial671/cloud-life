<?php

namespace App\Traits\Vehicle;

use Carbon\Carbon;

trait HasServiceStasuses{

    /**
     * If service is pending
     *
     * @return boolean
    */
    public function isPending()
    {
        return is_null($this->serviced_at);
    }
}
