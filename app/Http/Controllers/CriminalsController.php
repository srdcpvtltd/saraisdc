<?php

namespace App\Http\Controllers;

use App\Models\Criminal;
use Illuminate\Http\Request;
use App\DataTables\CriminalsDataTable;
use App\Http\Requests\CreateCriminalRqeuest;
use App\Http\Requests\CriminalRequest;
use App\Http\Requests\UpdateCriminalRequest;
use App\Models\CriminalBookingMatch;
use Illuminate\Support\Facades\Storage;

class CriminalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CriminalsDataTable $table)
    {

        return $table->render('criminals.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criminals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCriminalRqeuest $request)
    {

        try{
            $data = $request->all();
            //photo
            if ($request->file('photo')) {
                $extension = $request->file('photo')->getClientOriginalExtension();
                $documentName = time().'.'.$extension;

                Storage::disk('public')->put( 'criminals/'.$documentName, file_get_contents($request->photo));
                $data['photo'] = $documentName;

            }

            //save
            $criminal   = Criminal::create($data);

        } catch (\Exception $exception) {
            return redirect()->back()
            ->with('message', __('Error while saving data!'));
        }
        return redirect()->route('criminals.index')
            ->with('message', __('Criminal created successfully!'));
    }

    public function show(Criminal $criminal)
    {
        //
    }

    public function edit(Criminal $criminal)
    {

        return view('criminals.edit')->with(compact('criminal'));
    }

    public function update(UpdateCriminalRequest $request, Criminal $criminal)
    {
        try {

            $data = $request->all();

            //photo
            if ($request->file('photo')) {
                $extension = $request->file('photo')->getClientOriginalExtension();
                $documentName = time().'.'.$extension;
                Storage::disk('public')->put( 'criminals/'.$documentName, file_get_contents($request->photo));
                $data['photo'] = $documentName;
            }else{
                unset($data['photo']);
            }

            //save
            $criminal->update($data);

        } catch (\Exception $exception) {
            return redirect()->back()
            ->with('message', __('Error while saving data!'));
        }
        return redirect()->route('criminals.index')
            ->with('message', __('Data updated successfully!'));
    }

    public function destroy(Criminal $criminal)
    {
        try {

            CriminalBookingMatch::where('criminal_id',$criminal->id)->delete();

            $criminal->delete();

        } catch (\Exception $exception) {
            return redirect()->route('criminals.index')
            ->with('message', __('Error while deleting data!'));
        }
        return redirect()->route('criminals.index')
            ->with('message', __('Sucessfully Deleted!'));
    }
}
