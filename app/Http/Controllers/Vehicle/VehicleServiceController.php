<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\VehicleService;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class VehicleServiceController extends Controller
{
    /**
     * Show the form for creating a new vehicle service.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request, $vehicleId)
    {
        return view('vehicle.service.create', [
            'vehicle' =>  $request->user()->vehicles()->findOrFail($vehicleId),
            'types'   =>  VehicleService::getTypes(),
        ]);
    }

    /**
     * Store a newly created vehicle service in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $vehicleId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $vehicleId)
    {
        $validator = validator($request->all(), [
            'name'          => ['required', 'string'],
            'description'   => ['required', 'string'],
            'scheduled_at'  => ['required', 'date_format:Y-m-d'],
            'serviced_at'   => ['date_format:Y-m-d'],
            'type_id'       => ['required', Rule::in(VehicleService::getTypes()->keys())],
        ], [
            'type_id.in'    => 'Please select valid service type.',
        ]);

        if($validator->fails()){
            return back()->with(['error' => $validator->errors()->first()]);
        }

        if(! $request->has('serviced_at') && now()->startOfDay()->lessThan(new Carbon($request->scheduled_at))){
            return back()->with(['error' => 'Scheduled date must be today or any day in future if not past service.']);
        }

        $vehicle = $request->user()->vehicles()->findOrFail($vehicleId);


        if($vehicle->services()->onlyMonthly()->get()){
            return back()->with(['error' => 'You already have one monthly service which is not completed!']);
        }

        $vehicle->services()->create($validator->validated());

        return redirect()->route('vehicles.show', $vehicleId)->with(['success' => 'Successfully Created.']);
    }

    /**
     * Remove the specified service from storage.
     *
     * @param  int  $vehicleId
     * @param  int  $serviceId
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicleId, $serviceId)
    {
        $vehicle =  auth()->user()->vehicles()->findOrFail($vehicleId);
        $service =  $vehicle->services()->findOrFail($serviceId);

        $service->serviced_at = now();
        $service->save();

        $message = $service->name.' marked completed.';

        // Create next service if completed monthly one before.
        if($service->isMonthly()){
            $service = $service->replicate();
            $service->scheduled_at = now()->addDays($vehicle->monthly_service_in_days);
            $service->serviced_at = null;
            $service->save();

            $message .= ' New service '. $service->name .' has been generated for - '.$service->scheduledAt()->toFormattedDateString();
        }

        return back()->with(['success' => $message]);
    }
}
