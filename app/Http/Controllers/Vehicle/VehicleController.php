<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('vehicle.index', ['vehicles' => $request->user()->vehicles()->paginate(15)]);
    }

    /**
     * Show the form for creating a new vehicles.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('vehicle.create');
    }

    /**
     * Store a newly created vehicle in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name'        => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        if($validator->fails()){
            return back()->with(['error' => $validator->errors()->first()]);
        }

        Vehicle::create([
            'name'        => $request->name,
            'description' => $request->description,
            'user_id'     => $request->user()->id,
        ]);

        return redirect()->route('vehicles.index')->with(['success' => 'Successfully Created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
}
