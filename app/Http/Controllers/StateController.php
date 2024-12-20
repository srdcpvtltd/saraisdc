<?php

namespace App\Http\Controllers;

use App\Services\StateService;
use App\DataTables\StatesDataTable;
use App\Http\Requests\StateRequest;
use App\Models\State;
use App\Models\Country;


class StateController extends Controller
{
    protected $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDataTable $table)
    {
        return $table->render('states.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modual = State::get();
        $countries = Country::get();
        return view('states.create', compact('modual','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        $message='';
        try {
            //echo '<pre>';var_dump($request->all());exit;
            $stateService = $this->stateService->store($request, State::class);
            $message='State saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('states.index')
            ->with('message', __($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $country
     * @return \Illuminate\Http\Response
     */
    public function show(State $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $countries = Country::get();
        return view('states.edit')->with(compact('state','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StateRequest  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(StateRequest $request, State $state)
    {
        try {
            
            $this->stateService->update($request, $state);

            $message='State Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('states.index')
            ->with('message', __($message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(StateRequest $request,State $state)
    {
        try {
            $this->stateService->destroy($request, $state);

            $message='State Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('states.index')
            ->with('message', __($message));
    }
}
