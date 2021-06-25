<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use App\Models\VehicleService;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('vehicle.index', ['vehicles' => $request->user()->vehicles]);
    }

    /**
     * Show the form for creating a new vehicles.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('vehicle.create', ['categories' => VehicleCategory::all()]);
    }

    /**
     * Store a newly created vehicle in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'model'                   => ['required', 'string'],
            'detail'                  => ['required', 'string'],
            'manufacturer'            => ['required', 'string'],
            'rc'                      => ['required', 'string'],
            'monthly_service_in_days' => ['required', 'integer'],
            'category_id'             => ['required', 'integer', 'exists:vehicle_categories,id']
        ]);

        if($validator->fails()){
            return back()->with(['error' => $validator->errors()->first()]);
        }

        $request->user()->vehicles()->create($validator->validated());

        return redirect()->route('vehicles.index')->with(['success' => 'Successfully Created.']);
    }

    /**
     * Display the specified vehicle.
     *
     * @param  \Illuminate\Http\Request $vehicle
     * @param  Vehicle $vehicle
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Vehicle $vehicle)
    {
        $services = $vehicle->services()
                            ->orderBy('scheduled_at', 'desc')
                            ->paginate(7);

        return view('vehicle.show', [
            'vehicle'  => $vehicle,
            'services' => $services
        ]);
    }

    /**
     * Remove the specified vehicle from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyBulk(Request $request)
    {
        $validator = validator($request->all(), [
            'vehicles' => ['required', 'array', 'exists:vehicles,id'],
        ]);

        if($validator->fails()){
            return back()->with(['error' => $validator->errors()->first()]);
        }

        $request->user()->vehicles()->whereIn('id', $request->vehicles)->delete();

        return back()->with(['success' => "Successfully Deleted. Vehicle ID: ".implode(',', $request->vehicles)]);
    }

    /**
     * Destroy the vehicle.
     *
     * @param  Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return back()->with(['success' => "Successfully Deleted. Vehicle ID: ".$vehicle->id]);
    }
}
