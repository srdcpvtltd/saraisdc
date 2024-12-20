<?php

namespace App\Http\Controllers;

use App\Services\CountryService;
use App\DataTables\CountriesDataTable;
use App\Http\Requests\CountryRequest;
use App\Models\Country;


class CountryController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTable $table)
    {
        return $table->render('countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $message='';
        try {
            $countryService = $this->countryService->store($request, Country::class);
            $message='Country saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('countries.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        
        return view('countries.edit')->with(compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        try {
            $this->countryService->update($request, $country);

            $message='Country Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('countries.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountryRequest $request,Country $country)
    {
        try {
            $this->countryService->destroy($request, $country);

            $message='Country Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('countries.index')
            ->with('message', __($message));
    }
}
