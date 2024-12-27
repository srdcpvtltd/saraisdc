<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationSettingsDataTable;
use App\Models\NotificationSetting;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{


    public function index(NotificationSettingsDataTable $table)
    {
        if (\Auth::user()->can('manage-notification')) {
            return $table->render('notificationsettings.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function create()
    {
        if (\Auth::user()->can('create-notification')) {
            $modual = NotificationSetting::get();
            $countries = \DB::table('countries')->get();
            return view('notificationsettings.create', compact('modual', 'countries'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create-notification')) {
            //        dd($request->all());
            $modual = new NotificationSetting();
            $modual->name = $request->name;
            $modual->country = $request->country ?? null;
            $modual->state = $request->state ?? null;
            $modual->city = $request->city ?? null;
            $modual->age_from = $request->age_from ?? null;
            $modual->age_to = $request->age_to ?? null;
            $modual->save();

            return redirect()->route('notificationsettings.index')
                ->with('message', __('Notification updated successfully'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function show(NotificationSetting $modual) {}


    public function edit($id)
    {
        if (\Auth::user()->can('edit-notification')) {
            $modual = NotificationSetting::find($id);
            $countries = DB::table('countries')->get();
            $states = DB::table('states')->where('country_id', $modual->country)->get();
            $cities = DB::table('cities')->where('state_id', $modual->state)->get();
            return view('notificationsettings.edit', compact('modual', 'countries', 'states', 'cities'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edir-notification')) {
            $modules = NotificationSetting::find($id);

            $modules->name = $request->name;
            $modules->name = $request->name;
            $modules->country = $request->country ?? null;
            $modules->state = $request->state ?? null;
            $modules->city = $request->city ?? null;
            $modules->age_from = $request->age_from ?? null;
            $modules->age_to = $request->age_to ?? null;
            $modules->save();
            return redirect()->route('notificationsettings.index')->with('message', 'Notification Updated Sucessfully.');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete-notification')) {
            NotificationSetting::where('id', $id)->firstorfail()->delete();
            return redirect()->route('notificationsettings.index')->with('message', __('Notification change successfully.'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
