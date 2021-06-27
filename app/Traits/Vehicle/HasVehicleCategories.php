<?php

namespace App\Traits\Vehicle;

trait HasVehicleCategories
{
    /**
     * If category is of Two Wheeler.
     *
     * @return bool
     */
    public function isTwoWheeler()
    {
        return $this->name === 'Two Wheeler';
    }

    /**
     * If category is of Four Wheeler.
     *
     * @return bool
     */
    public function isFourWheeler()
    {
        return $this->name === 'Four Wheeler';
    }
}
