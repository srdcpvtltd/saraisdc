<?php

namespace App\Http\Controllers;

use App\DataTables\PoliceStationDataTable;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\PoliceStation;
use Illuminate\Http\Request;

class PoliceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PoliceStationDataTable $table)
    {
        return $table->render('police_station.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return view('police_station.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $message = '';
        try {
            $policestation = new PoliceStation();
            $policestation->code = $request->name;
            $policestation->city_id = $request->city_id;
            $policestation->save();

            $message = 'Police station saved successfully';
        } catch (\Exception $exception) {
            dd($exception);
            $message = 'Error has exit';
        }
        return redirect()->route('policestation.index')
            ->with('message', __($message));
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
        $policestation = PoliceStation::find($id);
        $city = City::where('id', $policestation->city_id)->first();
        $citty = City::all();
        $selected_country_id = $city->state->country_id;
        $selected_state_id = $city->state_id;
        $countries = Country::get();
        $states = State::get();

        return view('police_station.edit')->with(compact('city', 'citty', 'states', 'countries', 'policestation', 'selected_country_id', 'selected_state_id'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'city_id' => 'required|string|max:255',
        ]);
        $update = PoliceStation::find($id);
        if (!$update) {
            return redirect()->route('policestation.index')
                ->with('message', __('Police Station not found.'));
        }
        $update->code = $request->name;
        $update->city_id = $request->city_id;
        $update->save();
        return redirect()->route('policestation.index')
            ->with('message', __('Police Station updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $policestation = PoliceStation::find($id);
            if (!$policestation) {
                return redirect()->route('policestation.index')
                    ->with('message', __('Police Station not found.'));
            }
            $policestation->delete();

            return redirect()->route('policestation.index')
                ->with('message', __('Police Station deleted successfully.'));
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());

            return redirect()->route('policestation.index')
                ->with('message', __('An error occurred while deleting the Police Station.'));
        }
    }
}
