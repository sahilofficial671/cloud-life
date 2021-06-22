<?php

namespace App\Traits\Vehicle\Service;

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

    /**
     * If service is not pending
     *
     * @return boolean
    */
    public function isNotPending()
    {
        return ! is_null($this->serviced_at);
    }

    /**
     * If service is pending
     *
     * @return boolean
    */
    public function isOnlyPending()
    {
        return is_null($this->serviced_at)
                && is_null($this->completed_at)
                && is_null($this->canceled_at);
    }

    /**
     * If service is not pending
     *
     * @return boolean
    */
    public function isCanceled()
    {
        return isset($this->canceled_at);
    }

    /**
     * If service is not pending
     *
     * @return boolean
    */
    public function isCompleted()
    {
        return isset($this->completed_at);
    }
}
