<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\VehicleService;

class VehicleServiceController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicleId, $serviceId)
    {
        $vehicle =  auth()->user()->vehicles()->findOrFail($vehicleId);
        $service =  $vehicle->services()->findOrFail($serviceId);

        $service->serviced_at = now();
        $service->save();

        // Create next service
        $service = $service->replicate();
        $service->scheduled_at = now()->addDays($vehicle->monthly_service_in_days);
        $service->serviced_at = null;
        $service->save();

        return back()->with(['success' => $service->name.' completed.']);
    }
}
