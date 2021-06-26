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
    public function create(Request $request, Vehicle $vehicle)
    {
        return view('vehicle.service.create', [
            'vehicle' =>  $vehicle,
            'types'   =>  VehicleService::getTypes(),
        ]);
    }

    /**
     * Store a newly created vehicle service in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Vehicle $vehicle)
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

        // If not past service schedule at should be equal or greater than now.
        if(! $request->has('serviced_at') && ! (new Carbon($request->scheduled_at))->greaterThanOrEqualTo(now()->startOfDay())){
            return back()
                    ->with(['error' => 'Scheduled date must be today or any day in future if not past service.'])
                    ->withInput();
        }

        $services = $vehicle->services();

        // If trying to create monthly service but active monthly service already exists
        if ($request->type_id == VehicleService::TYPE_MONTHLY) {
            $disallow = $services->get()->filter(function($service){
                return $service->isMonthly() && $service->isPending();
            })->isNotEmpty();


            if($disallow){
                return back()
                        ->with(['error' => 'You already have one monthly service which is not completed! Mark that complete or cancel to continue.'])
                        ->withInput();
            }
        }

        $services->create($validator->validated());

        return redirect()->route('vehicles.show', $vehicle)->with(['success' => 'Successfully Created.']);
    }

    /**
     * Mark vehicle service serviced.
     *
     * @param  App\Models\Vehicle  $vehicle
     * @param  App\Models\VehicleService  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function serviced(Vehicle $vehicle, VehicleService $service)
    {
        $service->update([
            'serviced_at'  => now()
        ]);

        $message = $service->name.' has been marked completed.';

        // Create next service if completed monthly one before.
        if($service->isMonthly()){
            $service = $service->replicate();
            $service->scheduled_at = now()->startOfDay()->addDays($vehicle->monthly_service_in_days);
            $service->serviced_at = null;
            $service->save();

            $message .= sprintf('<br />New <span class="font-bold">%s</span> has been generated for - %s', $service->name, $service->scheduledAt()->toFormattedDateString());
        }

        return back()->with(['success' => $message]);
    }

    /**
     * Mark service complete.
     *
     * @param  App\Models\Vehicle  $vehicle
     * @param  App\Models\VehicleService  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(Vehicle $vehicle, VehicleService $service)
    {
        $service->update([
            'serviced_at'  => now(),
            'completed_at' => now()
        ]);

        return back()->with(['success' => $service->name.' has been completed.']);
    }

    /**
     * Mark service canceled.
     *
     * @param  App\Models\Vehicle  $vehicle
     * @param  App\Models\VehicleService  $service
     * @return \Illuminate\Http\Response
     */
    public function cancel(Vehicle $vehicle, VehicleService $service)
    {
        $service->update([
            'canceled_at' => now()
        ]);

        return back()->with(['success' => $service->name.' has been canceled.']);
    }
}
