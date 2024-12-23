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
        $message='';
        try {
            $policestation = new PoliceStation();
            $policestation->code = $request->name;
            $policestation->city_id = $request->city_id;
            $policestation->save();

            $message='Police station saved successfully';
        } catch (\Exception $exception) {
            dd($exception);
            $message='Error has exit';
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

        return view('police_station.edit')->with(compact('city','citty','states','countries', 'policestation', 'selected_country_id', 'selected_state_id'));
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
        try {
            
            $this->cityService->update($request, $city);

            $message='City Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('policestation.index')
            ->with('message', __($message));
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
}
