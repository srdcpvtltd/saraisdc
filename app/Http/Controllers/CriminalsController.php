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
        if (\Auth::user()->can('manage-criminals')) {
            return $table->render('criminals.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('create-criminals')) {
            return view('criminals.create');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCriminalRqeuest $request)
    {
        if (\Auth::user()->can('create-criminals')) {
            try {
                $data = $request->all();
                //photo
                if ($request->file('photo')) {
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $documentName = time() . '.' . $extension;

                    Storage::disk('public')->put('criminals/' . $documentName, file_get_contents($request->photo));
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
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function show(Criminal $criminal)
    {
        //
    }

    public function edit(Criminal $criminal)
    {
        if (\Auth::user()->can('edit-criminals')) {
            return view('criminals.edit')->with(compact('criminal'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function update(UpdateCriminalRequest $request, Criminal $criminal)
    {
        if (\Auth::user()->can('edit-criminals')) {
            try {

                $data = $request->all();

                //photo
                if ($request->file('photo')) {
                    $extension = $request->file('photo')->getClientOriginalExtension();
                    $documentName = time() . '.' . $extension;
                    Storage::disk('public')->put('criminals/' . $documentName, file_get_contents($request->photo));
                    $data['photo'] = $documentName;
                } else {
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
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function destroy(Criminal $criminal)
    {
        if (\Auth::user()->can('delete-criminals')) {
            try {

                CriminalBookingMatch::where('criminal_id', $criminal->id)->delete();

                $criminal->delete();
            } catch (\Exception $exception) {
                return redirect()->route('criminals.index')
                    ->with('message', __('Error while deleting data!'));
            }
            return redirect()->route('criminals.index')
                ->with('message', __('Sucessfully Deleted!'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
