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
        return is_null($this->serviced_at)
            && is_null($this->completed_at)
            && is_null($this->canceled_at);
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

    /**
     * If service is serviced
     *
     * @return boolean
    */
    public function isServiced()
    {
        return isset($this->serviced_at);
    }

    /**
     * Get service status type
     *
     * @return string
    */
    public function statusType()
    {
        $label = '';

        if($this->isPending()){
            $label = 'info';
        }else if($this->isCanceled()){
            $label = 'danger';
        }else if($this->isNotPending() || $this->isCompleted()){
            $label = 'success';
        }

        return $label;
    }

    /**
     * Get service status text
     *
     * @return string
    */
    public function statusText()
    {
        $text = '';

        if($this->isPending()){
            $text = 'Pending';
        }else if($this->isCanceled()){
            $text = 'Canceled';
        }else if($this->isNotPending() || $this->isCompleted()){
            $text = 'Completed';
        }

        return $text;
    }
}
