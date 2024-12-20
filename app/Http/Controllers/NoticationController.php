<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationSettingsDataTable;
use App\Models\NotificationSetting;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{


    public function index(NotificationSettingsDataTable $table)
    {
        if (\Auth::user()->can('manage-module')) {
            return $table->render('notificationsettings.index');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function create()
    {
        if (\Auth::user()->can('create-module')) {

            $modual = Modual::get();
            return view('moduals.create', compact('modual'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('create-module')) {

            $modual = new Modual();
            $modual->name = $request->name;
            $modual->state = $request->state;
            $modual->city = $request->city;
            $modual->age_from = $request->age_from;
            $modual->age_to = $request->age_to;
            $modual->save();
            $data = [];
            if (!empty($request['permissions'])) {
                foreach ($request['permissions'] as $check) {
                    if ($check == 'M') {
                        $data[] = ['name' => 'manage-' . $request->name];
                    } else if ($check == 'C') {
                        $data[] = ['name' => 'create-' . $request->name];
                    } else if ($check == 'E') {
                        $data[] = ['name' => 'edit-' . $request->name];
                    } else if ($check == 'D') {
                        $data[] = ['name' => 'delete-' . $request->name];
                    } else if ($check == 'S') {
                        $data[] = ['name' => 'show-' . $request->name];
                    }
                }
            }
            permission::insert($data);
            return redirect()->route('modules.index')
                ->with('message', __('modual updated successfully'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function show(Modual $modual)
    {
    }


    public function edit($id)
    {
        if (\Auth::user()->can('edit-module')) {

            $modual = Modual::find($id);
            return view('moduals.edit', compact('modual'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }


    public function update(Request $request, $id)
    {
        $modules = Modual::find($id);
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_\.]+$/|min:4|unique:moduals,name,' . $modules->id,
        ], [
            'regex' => 'Invalid Entry! Only letters,underscores,hypens and numbers are allowed',
        ]);
        $modules->name = str_replace(' ', '-', strtolower($request->name));
        $permissions = DB::table('permissions')
            ->where('name', 'like', '%' . $request->old_name . '%')
            ->get();
        $module_name  = str_replace(' ', '-', strtolower($request->name));
        foreach ($permissions as $permission) {
            $update_permission = permission::find($permission->id);
            if ($permission->name == 'manage-' . $request->old_name) {
                $update_permission->name = 'manage-' . $module_name;
            }
            if ($permission->name == 'create-' . $request->old_name) {
                $update_permission->name = 'create-' . $module_name;
            }
            if ($permission->name == 'edit-' . $request->old_name) {
                $update_permission->name = 'edit-' . $module_name;
            }
            if ($permission->name == 'delete-' . $request->old_name) {
                $update_permission->name = 'delete-' . $module_name;
            }
            if ($permission->name == 'show-' . $request->old_name) {
                $update_permission->name = 'show-' . $module_name;
            }
            $update_permission->save();
        }
        $modules->save();
        return redirect()->route('modules.index')->with('message', 'Module Updated Sucessfully.');
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete-module')) {

            Modual::where('id', $id)->firstorfail()->delete();
            return redirect()->route('modules.index')->with('message', __('Modual change successfully.'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
