<?php

namespace App\Traits\Vehicle\Service;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait HasServiceTypes
{
    /**
     * If service is type is monthly.
     *
     * @return bool
     */
    public function isMonthly()
    {
        return $this->type_id === self::TYPE_MONTHLY;
    }

    /**
     * If service is type is custom.
     *
     * @return bool
     */
    public function isCustom()
    {
        return $this->type_id === self::TYPE_CUSTOM;
    }

    /**
     * Get all service types.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getTypes()
    {
        return collect([
            self::TYPE_MONTHLY => 'Monthly Service',
            self::TYPE_CUSTOM  => 'Custom Service',
        ]);
    }

    /**
     * Get current service type.
     *
     * @return string
     */
    public function getType()
    {
        return [
            self::TYPE_MONTHLY => 'Monthly Service',
            self::TYPE_CUSTOM => 'Custom Service',
        ][$this->type_id];
    }

    /**
     * Apply the scope to for type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function onlyMonthly(Builder $builder)
    {
        $builder->where('type_id', self::TYPE_MONTHLY);
    }
}
