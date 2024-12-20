<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\DataTables\CitiesDataTable;
use App\Http\Requests\CityRequest;
use App\Models\State;
use App\Models\Country;
use App\Models\City;


class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDataTable $table)
    {
        return $table->render('cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $countries = Country::get();
        
        return view('cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $message='';
        try {
            //echo '<pre>';var_dump($request->all());exit;
            $cityService = $this->cityService->store($request, City::class);
            $message='City saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('cities.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $country
     * @return \Illuminate\Http\Response
     */
    public function show(City $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::get();
        $states = State::get();
        $selected_country_id=0;
        $selected_state_id=0;
        if($city->state!=null){
            $selected_country_id=$city->state->country_id;
            $selected_state_id=$city->state->id;
        }
        return view('cities.edit')->with(compact('city','states','countries','selected_country_id','selected_state_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        try {
            
            $this->cityService->update($request, $city);

            $message='City Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('cities.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(CityRequest $request,City $city)
    {
        try {
            $this->cityService->destroy($request, $city);

            $message='City Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('cities.index')
            ->with('message', __($message));
    }
}
